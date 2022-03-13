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

$(function () {
    // append to title when checked.
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

    //toggle options (via business permit checkbox option and others input field)
    function disableLabel(elem, isDisabled) {
        elem.css({
            "cursor": isDisabled ? "disabled" : "auto",
            "pointer-events": isDisabled ? "none" : "auto",
        });
    }

    disableLabel($('#label-business'), true);

    $('.'+selectBarangayDocuments).click(function() {
        var dropdown = $('.'+purposeSelecTitle);

        function unselectall() {
            $('.request-purpose').each(function(i, obj) {
                if (this.checked) $(this).trigger('click');
            });
        }

        if ($('.'+selectBarangayDocuments+':checkbox:checked').length >= 2) {
            unselectall();

            $('#others').trigger('click');

            disableLabel(dropdown, true);
        } else if ($('.'+selectBarangayDocuments+':checkbox:checked').length == 1 && $('#bp').is(':checked') && ! $('#business').is(':checked')) {
            unselectall();

            $('#business').trigger('click');

            disableLabel(dropdown, true);
        } else if ($('.'+selectBarangayDocuments+':checkbox:checked').length == 1 && ! $('#bp').is(':checked')) {
            disableLabel(dropdown, false);
        } else {
            unselectall();

            if ($('#others').is(':checked')) $('#others').trigger('click');
            
            disableLabel(dropdown, false);

            disableLabel($('#label-business'), true);
        }
    });
});

