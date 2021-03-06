<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeNewResidentDocumentRequest;
use App\Http\Services\RequestDocuments;
use App\Models\Document;
use App\Models\Request as ModelsRequest;
use App\Models\Resident;
use Illuminate\Http\Request;

class NewResidentRequestDocumentController extends Controller
{
    protected string $residentStatus = '';
    protected string $prevUrl = '';

    public function __construct()
    {
        $this->residentStatus = (new ModelsRequest())->resident_statuses['new_resident'];
        $this->prevUrl = '?' . substr(url()->previous(), strpos(url()->previous(), "?") + 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new-resident-request-document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\storeNewResidentDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeNewResidentDocumentRequest $request)
    {
        try {
            $resident = Resident::findRecord($request->last_name, $request->first_name, $request->middle_name, $request->suffix, $request->house_number)->first();

            if (!is_null($resident)) return redirect()->back()->with('modal', 'showNoticeModal')
                ->withInput($request->all())
                ->with('error', [
                    'title' => 'Notice!',
                    'message' => 'You already have a record in our barangay. Please proceed to the Current Resident Request Form.',
                    'link' => '<a href="'.route("current_resident.requests.create", $resident->resident_id).'" class="btn btn-primary form-btn btn-next border-0 main-cta">Okay</a>'
                ]);

            //validate age
            if ($request->age <= 0) return redirect()->back()
                ->withInput($request->all())
                ->with('modal', 'confirmModal')
                ->with('error', [
                    'title' => 'Error',
                    'message' => "Invalid Birthdate!",
                ]);

            //validate requested documents
            $requestDocuments = new RequestDocuments();

            array_push($requestDocuments->storeRequest['require_document'], $request->cor, $request->coi, $request->bc, $request->bp);
            array_push($requestDocuments->storeRequest['require_purpose'], $request->sch, $request->pas, $request->gov, $request->lto, $request->has('oth') ? $request->purpose : null);

            $validated = $requestDocuments->validateRequestedDocuments($requestDocuments->storeRequest);

            if (is_string($validated))
                return redirect()->back()->withInput($request->all())->with(
                    strtok($validated, $requestDocuments->errorMessageSeparator),
                    substr($validated, strpos($validated, $requestDocuments->errorMessageSeparator) + 1)
                );

            //create resident
            $resident = Resident::create(array_merge(
                $request->only(
                    'last_name',
                    'first_name',
                    'middle_name',
                    'suffix',
                    'house_number',
                    'alias',
                    'birth_date',
                    'place_of_birth',
                    'sex',
                    'citizenship',
                    'civil_status',
                    'religion',
                    'blood_type',
                    'pwd',
                    'years_of_residence',
                    'member_4ps',
                    'voter_status',
                    'identified_as',
                    'email_add',
                    'emp_stat',
                    'occupation',
                    'emp_name',
                    'monthly_income',
                    'floor_no',
                    'block_no',
                    'street_name',
                    'family_relation',
                    'sss_no',
                    'tin_no',
                    'gsis_no',
                    'pagibig_no',
                    'philhealth_no',
                ),
                ['contact_no' => $request->contact_number]
            ));

            $modelsRequest = ModelsRequest::create(
                array_merge(
                    $request->only('last_name', 'first_name', 'middle_name', 'suffix', 'house_number', 'email_add', 'contact_number', 'name_of_witness'),
                    [
                        'resident_id' => $resident->resident_id,
                        'street' => $request->street_name,
                        'resident_status' => $this->residentStatus,
                        'purpose' => implode(', ', $validated['require_purpose']),
                    ]
                )
            );

            $requestDocuments->createRequestedDocuments(
                $modelsRequest,
                $validated['require_document'],
                array((new Document())->barangayDocuments['b'] => $request->only('business_name', 'business_nature', 'business_owner', 'business_add'))
            );

            return redirect()->route('new_resident.requests.show', $modelsRequest);
        } catch (\Exception $e) {
            return redirect()->back()->with('modal', 'confirmModal')
                ->with('error', [
                    'title' => 'Error',
                    'message' => $e->getMessage(),
                ]);
        }
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);

        $latestRequest = $resident->requests()->latest()->first();

        if ($latestRequest->confirmed_at) return redirect()->route('home');

        $document = null;

        foreach ($latestRequest->documents as $doc) {
            if ($doc->business_permit) $document = $doc;
        }

        return view('new-resident-request-document.edit', compact('resident', 'latestRequest', 'document'));
    }

    public function update($id, storeNewResidentDocumentRequest $request)
    {
        try {
            $residentOrig = Resident::findRecord($request->last_name, $request->first_name, $request->middle_name, $request->suffix, $request->house_number)->first();

            $modelsRequest = ModelsRequest::findOrFail($id);

            if ($modelsRequest->confirmed_at) return redirect()->route('home');

            $resident = $modelsRequest->resident;

            if (! is_null($residentOrig) && $residentOrig->resident_id !== $resident->resident_id) return redirect()->back()->with('modal', 'showNoticeModal')
                ->withInput($request->all())
                ->with('error', [
                    'title' => 'Notice!',
                    'message' => 'You already have a record in our barangay. Please proceed to the Current Resident Request Form.',
                    'link' => '<a href="'.route("new_resident.requests.current", ['id' => $resident->resident_id, 'idOrig' => $residentOrig->resident_id]).'" class="btn btn-primary form-btn btn-next border-0 main-cta">Okay</a>'
                ]);

            $oldRequest = $modelsRequest;

            if ($request->age <= 0) return redirect()->back()
                ->withInput($request->all())
                ->with('modal', 'confirmModal')
                ->with('error', [
                    'title' => 'Error',
                    'message' => "Invalid Birthdate!",
                ]);

            $requestDocuments = new RequestDocuments();

            array_push($requestDocuments->storeRequest['require_document'], $request->cor, $request->coi, $request->bc, $request->bp);
            array_push($requestDocuments->storeRequest['require_purpose'], $request->sch, $request->pas, $request->gov, $request->lto, $request->has('oth') ? $request->purpose : null);

            $validated = $requestDocuments->validateRequestedDocuments($requestDocuments->storeRequest);

            if (is_string($validated))
                return redirect()->back()->withInput($request->all())->with(
                    strtok($validated, $requestDocuments->errorMessageSeparator),
                    substr($validated, strpos($validated, $requestDocuments->errorMessageSeparator) + 1)
                );

            $modelsRequest = ModelsRequest::create(
                array_merge(
                    $request->only('last_name', 'first_name', 'middle_name', 'suffix', 'house_number', 'email_add', 'contact_number', 'name_of_witness'),
                    [
                        'resident_id' => $resident->resident_id,
                        'street' => $request->street_name,
                        'resident_status' => $this->residentStatus,
                        'purpose' => implode(', ', $validated['require_purpose']),
                    ]
                )
            );

            $requestDocuments->createRequestedDocuments(
                $modelsRequest,
                $validated['require_document'],
                array((new Document())->barangayDocuments['b'] => $request->only('business_name', 'business_nature', 'business_owner', 'business_add'))
            );

            $oldRequest->delete();

            return redirect()->route('new_resident.requests.show', $modelsRequest);
        } catch (\Exception $e) {
            return redirect()->back()->with('modal', 'confirmModal')
                ->with('error', [
                    'title' => 'Error',
                    'message' => $e->getMessage(),
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelsRequest = ModelsRequest::with('documents', 'resident')->findOrFail($id);

        $url = $this->prevUrl;

        if ($modelsRequest->confirmed_at) return redirect()->route('home');

        if ($modelsRequest->resident_status != $this->residentStatus) abort(404);

        return view('new-resident-request-document.show', compact('modelsRequest', 'url'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Resident::findOrFail($id)->delete();

        return redirect()->route('home');
    }

    public function current($id, $idOrig)
    {
        Resident::findOrFail($id)->delete();

        return redirect()->route('current_resident.requests.create', $idOrig);
    }
}
