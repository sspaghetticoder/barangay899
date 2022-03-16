<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmDocumentRequest;
use App\Http\Requests\storeCurrentResidentDocumentRequest;
use App\Http\Services\RequestDocuments;
use App\Models\Document;
use App\Models\Request as ModelsRequest;
use App\Models\Resident;

class CurrentResidentRequestDocumentController extends Controller
{
    protected string $residentStatus = '';
    protected string $prevUrl = '';

    public function __construct()
    {
        $this->residentStatus = (new ModelsRequest())->resident_statuses['current_resident'];
        $this->prevUrl = '?' . substr(url()->previous(), strpos(url()->previous(), "?") + 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Responsen
     */
    public function create($id = null)
    {
        $resident = Resident::find($id);

        return view('current-resident-request-document.create', compact('resident'));
    }

    /** j.
     * Store a newly created resource in storage.
     * 
     * validate post request using storeCurrentResidentDocumentRequest
     * @param  \Illuminate\Http\Requests\storeCurrentResidentDocumentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeCurrentResidentDocumentRequest $request)
    {
        try {
            //scope query
            $resident = Resident::findRecord($request->last_name, $request->first_name, $request->middle_name, $request->suffix, $request->house_number)->first();

            //no record in the database
            if (is_null($resident)) return redirect()->back()->with('modal', 'showNoticeModal')
                ->withInput($request->all())
                ->with('error', [
                    'title' => 'Notice!',
                    'message' => "You don't have any records yet in our barangay. Please proceed to the New Resident Request Form.",
                    'link' => '<a href="'.route("new_resident.requests.create").'" class="btn btn-primary form-btn btn-next border-0 main-cta">Okay</a>'
                ]);

            //check App -> Http -> Services.
            $requestDocuments = new RequestDocuments();

            array_push($requestDocuments->storeRequest['require_document'], $request->cor, $request->coi, $request->bc, $request->bp);
            array_push($requestDocuments->storeRequest['require_purpose'], $request->sch, $request->pas, $request->gov, $request->lto, $request->has('oth') ? $request->purpose : null);

            $validated = $requestDocuments->validateRequestedDocuments($requestDocuments->storeRequest);

            if (is_string($validated))
                // get error key and error message then redirect back to display error message (for dropdowns).
                return redirect()->back()->withInput($request->all())->with(
                    strtok($validated, $requestDocuments->errorMessageSeparator),
                    substr($validated, strpos($validated, $requestDocuments->errorMessageSeparator) + 1)
                );

            $modelsRequest = ModelsRequest::create(
                array_merge(
                    $request->only('last_name', 'first_name', 'middle_name', 'suffix', 'house_number', 'street', 'email_add', 'contact_number'),
                    [
                        'resident_id' => $resident->resident_id,
                        'resident_status' => $this->residentStatus,
                        'purpose' => implode(', ', $validated['require_purpose']),
                    ]
                )
            );

            // create requested documents
            $requestDocuments->createRequestedDocuments(
                $modelsRequest,
                $validated['require_document'],
                array((new Document())->barangayDocuments['b'] => $request->only('business_name', 'business_nature', 'business_owner', 'business_add'))
            );

            return redirect()->route('current_resident.requests.show', $modelsRequest);
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

        return view('current-resident-request-document.edit', compact('resident', 'latestRequest', 'document'));
    }

    public function update($id, storeCurrentResidentDocumentRequest $request)
    {
        try {
            $resident = Resident::findRecord($request->last_name, $request->first_name, $request->middle_name, $request->suffix, $request->house_number)->first();

            if (is_null($resident)) return redirect()->back()->with('modal', 'showNoticeModal')
                ->withInput($request->all())
                ->with('error', [
                    'title' => 'Notice!',
                    'message' => "You don't have any records yet in our barangay. Please proceed to the New Resident Request Form.",
                    'link' => '<a href="'.route("current_resident.requests.new", $id).'" class="btn btn-primary form-btn btn-next border-0 main-cta">Okay</a>'
                ]);

            $modelsRequest = ModelsRequest::findOrFail($id);

            if ($modelsRequest->confirmed_at) return redirect()->route('home');

            $resident = $modelsRequest->resident;

            $modelsRequest->delete();

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
                    $request->only('last_name', 'first_name', 'middle_name', 'suffix', 'house_number', 'street', 'email_add', 'contact_number'),
                    [
                        'resident_id' => $resident->resident_id,
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

            return redirect()->route('current_resident.requests.show', $modelsRequest);
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
        $modelsRequest = ModelsRequest::with('documents.business_permit')->findOrFail($id);
        $url = $this->prevUrl;

        if ($modelsRequest->confirmed_at) return redirect()->route('home');

        if ($modelsRequest->resident_status != $this->residentStatus) abort(404);

        return view('current-resident-request-document.show', compact('modelsRequest', 'url'));
    }

    /**
     * Confirm the specified resource.
     * @param  \Illuminate\Http\Requests\ConfirmDocumentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function confirm($id, ConfirmDocumentRequest $request)
    {
        $modelsRequest = ModelsRequest::findOrFail($id);
        $modelsRequest->confirmed_at = now();
        $modelsRequest->save();

        return redirect()->route('home');
    }

    /**
     * Destroy the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ModelsRequest::findOrFail($id)->delete();

        return redirect()->route('home');

        // return redirect()->route('current_resident.requests.create');
    }

    public function new($id)
    {
        ModelsRequest::findOrFail($id)->delete();

        return redirect()->route('new_resident.requests.create');
    }
}
