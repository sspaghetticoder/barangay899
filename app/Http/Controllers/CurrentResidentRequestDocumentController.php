<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmDocumentRequest;
use App\Http\Requests\storeCurrentResidentDocumentRequest;
use App\Http\Services\RequestDocuments;
use App\Models\Document;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CurrentResidentRequestDocumentController extends Controller
{
    protected string $residentStatus = '';

    public function __construct()
    {
        $this->residentStatus = (new ModelsRequest())->resident_statuses['current_resident'];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('current-resident-request-document.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * validate post request using storeCurrentResidentDocumentRequest
     * @param  \Illuminate\Http\Requests\storeCurrentResidentDocumentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeCurrentResidentDocumentRequest $request)
    {
        try {
            //check App -> Http -> Services.
            $requestDocuments = new RequestDocuments();

            array_push($requestDocuments->storeRequest['require_document'], $request->cor, $request->coi, $request->bc, $request->bp);
            array_push($requestDocuments->storeRequest['require_purpose'], $request->sch, $request->pas, $request->gov, $request->has('oth') ? $request->purpose : null);

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
                        // 'resident_id' => $resident->id | retrieve resident id
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
            return redirect()->back()->with('showModal', '')
                ->with('Exception', [
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
        $modelsRequest = ModelsRequest::with('documents')->findOrFail($id);

        if ($modelsRequest->confirmed_at) return redirect()->route('home');

        if ($modelsRequest->resident_status != $this->residentStatus) abort(404);

        return view('current-resident-request-document.show', compact('modelsRequest'));
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

        return redirect()->route('home')->with('showModal', '');
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

        return redirect()->route('current_resident.requests.create');
    }
}
