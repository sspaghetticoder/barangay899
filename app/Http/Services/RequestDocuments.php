<?php

namespace App\Http\Services;

use App\Models\Document;
use App\Models\Request as ModelsRequest;

class RequestDocuments
{
    public string $errorMessageSeparator = '+';

    public array $storeRequest = [
        'require_document' => [],
        'require_document_error_message' => 'Please select at least one (1) barangay document',
        'require_purpose' => [],
        'require_purpose_error_message' => 'Please select at least one (1) purpose',
    ];

    public function validateRequestedDocuments(array $storeRequest = [])
    {
        foreach($storeRequest as $key => $requests) {
            if (! is_array($requests)) continue;

            $storeRequest[$key] = array_filter($requests);

            // check if user selected at least one item in custom dropdown (documents or purpose).
            if (is_array($storeRequest[$key]) && empty($storeRequest[$key])) {
                // use `+` to separate error key and error message.
                return $key.$this->errorMessageSeparator.$storeRequest[$key.'_error_message'];
            }
        }

        return $storeRequest;
    }

    public function createRequestedDocuments(ModelsRequest $modelsRequest, array $requestedDocuments = [], array $createRequestedDocuments = []) : void
    {
        foreach($requestedDocuments as $documentType) {
            $document = new Document();

            // check if requested document is a valid document type. See Models -> Request.php
            if (! array_key_exists($documentType, $document->barangayDocuments)) continue;

            $doc = $modelsRequest->documents()->create(['document_type' =>  $documentType]);

            foreach($createRequestedDocuments as $type => $documentInfo) {
                //if Business Permit
                if ($document->barangayDocuments[$documentType] == $type) $doc->business_permit()->create($documentInfo);
            }
        }

        return;
    }
}