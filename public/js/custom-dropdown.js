(function ($) {
    $.fn.multiselect = function () {

        var selector = this;
        var options = $.extend({
            onChange: function () { }
        }, arguments[0] || {});

        activate();

        function activate() {

            //events
            $(selector).find('.title').on('click', function (e) {
                $(".custom-dropdown-error").toggle();
                $(".select-options").css("display", "none");
                $(".select-options").toggleClass('current-select-options');
                $(this).parent().find('.current-select-options').toggle();
            });

            $(selector).find('input[type="checkbox"]').change(function (e) {
                options.onChange.call(this);
            });
        }
    };
}(jQuery));

$(document).ready(function () {
    function toggleRequiredAttribute(element) {
        if (element.hasAttribute('required')) {
            element.required = false;
        } else {
            element.required = true;
        }
    }

    document.getElementById('bp').addEventListener('click', function () {
        var inputs = document.querySelectorAll('.business-permit-input');

        inputs.forEach(element => {
            element.classList.toggle("d-none");
            toggleRequiredAttribute(element.children[0]);
        });
    });

    document.getElementById('others').addEventListener('click', function () {
        document.querySelector('.specify-others-input').classList.toggle("d-none");
        toggleRequiredAttribute(document.querySelector('.specify-others-input').children[0]);
    });

    $('.select-list').multiselect({
        onChange: updateTable
    });
});

function updateTable() {
    var checkboxValue = $(this).val();
    var isChecked = $(this).is(':checked');
}

// append to title when checked.
$(function () {
    function appendCheckboxToTitle(className, dataAttribute, selectTitle, title) {
        var documents = $("." + className + ":checked").map(function () {
            return $(this).data(dataAttribute);
        }).toArray();

        if (documents.length === 0) {
            $("." + selectTitle).css("background-color", "white");
            $("." + selectTitle).css("color", "#B8B8B8");

            return $("." + selectTitle).text(title);
        }

        $("." + selectTitle).css("background-color", "#E9E9E9");
        $("." + selectTitle).css("color", "black");

        return $("." + selectTitle).text(documents.join(", "));
    }

    var selectBarangayDocuments = 'barangay-document';
    var documentAttribute = 'document';
    var documentSelecTitle = 'title-barangay-documents';
    var documentDefaulTitle = 'Select any barangay document you want to request';

    $("." + selectBarangayDocuments).change(function () {
        appendCheckboxToTitle(selectBarangayDocuments, documentAttribute, documentSelecTitle, documentDefaulTitle);
    });

    appendCheckboxToTitle(selectBarangayDocuments, documentAttribute, documentSelecTitle, documentDefaulTitle);

    var selectRequestPurpose = 'request-purpose';
    var purposeAttribute = 'purpose';
    var purposeSelecTitle = 'title-request-purpose';
    var purposeDefaulTitle = 'Purpose of Request';

    $("." + selectRequestPurpose).change(function () {
        appendCheckboxToTitle(selectRequestPurpose, purposeAttribute, purposeSelecTitle, purposeDefaulTitle);
    });

    appendCheckboxToTitle(selectRequestPurpose, purposeAttribute, purposeSelecTitle, purposeDefaulTitle);
});

