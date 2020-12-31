// =======local storage & session storage=======//

// destroyed once the user closes the browser 
function setSession(key, value) {
    sessionStorage.setItem(key, value);
}

function getSession(key) {
    return sessionStorage.getItem(key);
}

function removeSession(key) {
    sessionStorage.removeItem(key);
}

function clearSession() {
    return sessionStorage.clear();
}

// stores data with no expiration date

function setLocal(key, value) {
    localStorage.setItem(key, value);
}

function getLocal(key) {
    return localStorage.getItem(key);
}

function removeLocal(key) {
    localStorage.removeItem(key);
}

function clearLocal() {
    localStorage.clear();
}

const capitalize = (str, lower = false) =>
    (lower ? str.toLowerCase() : str).replace(/(?:^|\s|["'([{])+\S/g, match => match.toUpperCase());

// =======local storage & session storage=======//

// tooltip
function myTooltip() {
    var inputs = $('input');
    $.each(inputs, function(indexInArray, valueOfElement) {
        if ($(this).attr('title') != undefined) {
            $(this).tooltip({
                html: true,
                trigger: 'focus'
            });
        }
    });

    var textareas = $('textarea');
    $.each(textareas, function(indexInArray, valueOfElement) {
        if ($(this).attr('title') != undefined) {
            $(this).tooltip({
                html: true,
                trigger: 'focus'
            });
        }
    });
}
// tooltip

// convert number to price format with numeral js
function convertPrice(elem) {
    var value = numeral(elem.val()).value();
    if (value == null) {
        value = 0;
    }
    elem.val(numeral(value).format('0,0'));
    if (elem.siblings('.basePrice').length != 0) {
        elem.siblings('.basePrice').val(value);
    }
    if (elem.parents('.col-auto').find('.basePrice').length != 0) {
        elem.parents('.col-auto').find('.basePrice').val(value);
    }
}
// convert number to price format with numeral js

baseRoot = $('#baseRoot').html().trim();
baseAdminUrl = baseRoot + '/admin';
assetPath = baseRoot + '/asset/admin'

$("img").on('error', function() {
    $(this).attr('src', baseRoot + '/asset/noImage.png');
});


$(function() {

    var csrf = $('input[name=_token]').val();
    var timer;

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': csrf

        }

    });

    // print
    $('.printButton').on('click', function() {
        window.open($(this).data('url'), '', 'height=600,width=1000');

    });;


    // init the select2
    $.each($('.select2'), function(indexInArray, valueOfElement) {

        var placeholder = $(this).data('placeholder');

        $(this).select2({
            placeholder: placeholder,
        });

    });

    if ($('.select2').attr('title') != undefined) {
        $(".select2-container").tooltip({
            title: function() {
                return $(this).prev().attr("title");
            },
            placement: "auto",
            trigger: "focus"
        });
    }
    // init the select2

    myTooltip();

    $('[data-toggle=tooltip]').tooltip();

    // ==============flatpicker config==================
    locale = 'en';
    if ($('html').attr('lang') == 'fa') {
        window.Date = window.JDate;
        locale = 'fa';
    }
    $(".dateAndTimePicker").flatpickr({
        "locale": locale,
        enableTime: true,
        dateFormat: "Y-m-d H:i:S",
        time_24hr: true
    });
    $(".datePicker").flatpickr({
        "locale": locale,
        enableTime: false,
        dateFormat: "Y-m-d",
        time_24hr: false
    });

    // ==============flatpicker config==================

    //***********************************************
    //***********************************************
    //***********************************************


    // ============numeral js config====================


    $('.convertPrice').on('keyup', function() {
        convertPrice($(this));
    });

    // ============numeral js config====================

    // ==============toaster config=====================
    if ($('html').attr('dir') == 'rtl') {
        var positionClass = 'toast-top-left';
    } else {
        var positionClass = 'toast-top-right';
    }
    toastr.options = {
        "closeButton": true,
        "debug": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": positionClass,
        "preventDuplicates": false,
        "showDuration": "8000",
        "hideDuration": "8000",
        "timeOut": "8000",
        "extendedTimeOut": "8000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    // ==============toaster config==================

    //***********************************************
    //***********************************************
    //***********************************************

    // =============ck editor config=================
    if ($('.ck-editor').length > 0) {

        $('.ck-editor').each(function() {
            var accept = $(this).data('accept');
            CKEDITOR.replace($(this).attr('id'), {
                language: $('html').attr('lang'),
                skin: 'icy_orange',
                filebrowserBrowseUrl: mediaRoute('atriatech.media.index'),
                filebrowserImageBrowseUrl: mediaRoute('atriatech.media.index') + `?accept=${accept}`,
                removeDialogTabs: 'link:upload;image:upload'
            });
        });

    }

    /* ckeditor plugin simple */
    if ($('.ck-editor-simple').length > 0) {
        var accept = $(this).data('accept');
        CKEDITOR.replace($('.ck-editor-simple').attr('id'), {
            language: $('html').attr('lang'),
            filebrowserBrowseUrl: mediaRoute('atriatech.media.index'),
            filebrowserImageBrowseUrl: mediaRoute('atriatech.media.index') + `?accept=${accept}`,
            removeDialogTabs: 'link:upload;image:upload',
            toolbarGroups: [
                { name: 'tools', groups: ['tools'] },
                { name: 'links', groups: ['links'] },
                { name: 'insert', groups: ['insert'] },
                { name: 'paragraph', groups: ['list', 'indent', 'align'] }
            ],
            removeButtons: 'Anchor,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,ShowBlocks,Slider',
            height: 60,
            width: '100%'
        });
    }
    // =============ck editor config=================

    //***********************************************
    //***********************************************
    //***********************************************

    // ============common things config==============

    // see the password
    $(".toggle-password").click(function() {

        $(this).children('i').toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    // see the password

    // count the <th></th> for no result

    let noResultCount = $('.noResult').parents('table').find('thead th').length;
    if (noResultCount > 0) {
        $('.noResult').attr('colspan', noResultCount);
    }

    // count the <th></th> for no result

    // delete item
    $(".deleteItem").on('click', function() {
        deleteItem($(this));
    });

    function deleteItem(elem) {

        var name = elem.data('name');
        var warning = elem.data('warning');
        var soft = elem.data('soft');
        var type = elem.data('type');

        var msgText = '<p class="text-dark h5 m-2">' + type + '</p>';
        var cancelBtn = window.i18n.common['deleteCancel'];
        if (soft) {
            var deleteBtn = window.i18n.common['deleteConfirmSoft'];
            msgText += window.i18n.common['deleteSoft'] + ' : ' + name;
            if (warning == 1) {
                msgText += `<br/> <h6 class="text-danger">${window.i18n.common['deleteWarningSoft'].replace("XXX", name)}</h6>`;
            }
        } else {
            var deleteBtn = window.i18n.common['deleteConfirm'];
            msgText += window.i18n.common['deleteItem'] + ' : ' + name;
            if (warning == 1) {
                msgText += `<br/> <h6 class="text-danger">${window.i18n.common['deleteWarning'].replace("XXX", name)}</h6>`;
            }
        }
        var url = elem.data('url');

        deleteRow(elem, msgText, deleteBtn, cancelBtn, url, {
            delete: 1,
            _method: "DELETE"
        });

    }

    function deleteRow(elem, msgText, deleteBtn, cancelBtn, url, data) {

        if ($('html').attr('dir') == 'ltr') {
            var reverseButtonsDir = !0;
        } else {
            var reverseButtonsDir = 0;
        }

        Swal.fire({
            title: window.i18n.common['deleteTitle'],
            html: msgText,
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: deleteBtn,
            cancelButtonText: cancelBtn,
            reverseButtons: reverseButtonsDir
        }).then(function(t) {
            if (t.value == true) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    success: function() {
                        // increase the trash count
                        var trashCount = $('#trashCount').html();
                        if (trashCount != undefined) {
                            $('#trashCount').html(Number(trashCount) + 1);
                        }

                        Swal.fire({
                            title: "Done",
                            html: window.i18n.common['successMsg'],
                            type: "success",
                            onClose: deleteModalOnClose
                        });

                        var tbody = elem.parents('tbody')
                        var checkTr = elem.parents('tr');
                        if (checkTr.length == 0) {
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            elem.parents('tr').remove();
                            var check = $('tbody tr');
                            var countTh = $('thead tr th').length;
                            var checkAdditionalTr = tbody.find('.additionalTr');
                            if ((check.length - checkAdditionalTr.length) <= 0) {
                                $('tbody').html(`<tr><td colspan="${countTh}" class="alert-danger p-2 text-center">${ window.i18n.common['noResult'] }</td></tr>`);
                            }
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", window.i18n.common['errorMsg'], "error");
                    }
                });

            }
        })
    }

    function deleteModalOnClose() {

        if ($('.trashButton').length > 0) {

            $("html, body").animate({
                scrollTop: $(".trashButton").offset().top - 130
            }, "800", "swing");

            clearTimeout(timer);
            timer = setTimeout(() => {
                $(".trashButton").focus();
            }, 1000);
            timer = setTimeout(() => {
                $(".trashButton").blur();
            }, 2500);

        }

    }
    // delete item

    // restore item
    $(".restoreItem").on('click', function() {
        restoreItem($(this));
    });

    function restoreItem(elem) {

        var name = elem.data('name');
        var url = elem.data('url');
        if ($('html').attr('dir') == 'ltr') {
            var reverseButtonsDir = !0;
        } else {
            var reverseButtonsDir = 0;
        }

        Swal.fire({
            title: window.i18n.common['askTitle'],
            html: window.i18n.common['restore'] + ' : ' + name,
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: window.i18n.common['restoreBtn'],
            cancelButtonText: window.i18n.common['cancel'],
            reverseButtons: reverseButtonsDir
        }).then(function(t) {
            if (t.value == true) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    success: function() {

                        Swal.fire("Done", window.i18n.common['successMsg'], "success");

                        elem.closest('tr').remove();
                        var check = $('tbody tr');
                        var countTh = $('thead tr th').length;
                        var checkAdditionalTr = $('tbody').find('.additionalTr');
                        if ((check.length - checkAdditionalTr.length) <= 0) {
                            $('tbody').html(`<tr><td colspan="${countTh}" class="alert-danger p-2 text-center">${ window.i18n.common['noResult'] }</td></tr>`);
                        }

                    },
                    error: function() {
                        Swal.fire("Error!", window.i18n.common['errorMsg'], "error");
                    }
                });

            }
        })



    }
    // restore item


    // activate and inactive status

    $.fn.editableform.buttons = '<button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>';
    $(".changeIsActive").editable({
        mode: "popup",
        inputclass: "form-control-sm",
        source: [{ value: 1, text: window.i18n.common['active'] }, { value: 0, text: window.i18n.common['inactive'] }],
        display: function(t, e) {
            var n = $.grep(e, function(e) { return e.value == t });
            n.length ? $(this).text(n[0].text).css("color", { 1: "#1abc9c", 0: "#f1556c" }[t]) : $(this).empty()
        },
        params: function(params) {
            params.model = $('.changeIsActive').data('model');
            params.can = $('.changeIsActive').data('can');
            return params;
        },
        success: function(response) {
            toastr['success'](window.i18n.common.successMsg);
        },
        error: function(response) {
            toastr['error'](window.i18n.common.errorMsg);
        }
    });


    // activate and inactive status

    // change priority

    $(".changePriority").editable({
        mode: "popup",
        inputclass: "form-control-sm",
        params: function(params) {
            params.model = $('.changePriority').data('model');
            params.can = $('.changePriority').data('can');
            return params;
        },
        success: function(response) {
            toastr['success'](window.i18n.common.successMsg);
            setTimeout(() => {
                sortTableBaseOnPriority();
            }, 1000);
        },
        error: function(response) {
            toastr['error'](window.i18n.common.errorMsg);
        }
    });

    function sortTableBaseOnPriority() {

        var table = $('.changePriority').first().parents('table');
        var counter = 0;
        while (counter < 500) {
            counter++;
            var tr = table.find('tr');
            $.each(tr, function(indexInArray, valueOfElement) {
                if (indexInArray == 0) {
                    return;
                }
                if (indexInArray <= tr.length - 1) {
                    if (Number($(this).find('.changePriority').html()) < Number(tr.eq(indexInArray + 1).find('.changePriority').html())) {

                        $(this).insertAfter(tr.eq(indexInArray + 1));
                        return false;

                    }
                } else {
                    return false;
                }
            });
        }
    }

    // change priority

    // seconds
    let timerOn = true;

    function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;

        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        $('#seconds').html(m + ':' + s);
        remaining -= 1;

        if (remaining >= 0 && timerOn) {
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
        }

        if (!timerOn) {
            // Do validate stuff here
            return;
        }

        $('#seconds').parents('.alert-warning').remove();

    }

    if ($('#seconds').length > 0) {
        timer($('#seconds').html());
    }

    // seconds

    // =============== get the active sidebar ============//
    if ($("#side-menu a.active").length > 0) {

        targetElement = $("#side-menu a.active");
        targetElement.parents('li').addClass('active');
        targetElement.parents('.nav-second-level').addClass('in');
        targetElement.parents('.nav-third-level').addClass('in');

    } else {
        var URL = window.location.href.split(/[?#]/)[0];
        var mostSimilarLinkScore = 0;
        var mostSimilarLink;
        $.each($('.slimscroll-menu a'), function(indexInArray, valueOfElement) {
            checkSimilarity(URL, $(this).attr('href'));
        });

        function checkSimilarity(currentUrl, link) {
            var currentSimilarity = similarity(currentUrl, link);
            if (currentSimilarity > mostSimilarLinkScore) {
                mostSimilarLinkScore = currentSimilarity;
                mostSimilarLink = link;
            }
        }
        if (mostSimilarLinkScore > 0 && mostSimilarLinkScore < 1) {
            var targetElement = $(`.slimscroll-menu .metismenu > li:not(.adminLi)`).find(`a[href^="${mostSimilarLink}"]`);
            if (targetElement.length > 0) {
                targetElement.parents('li').parents('li').addClass('active');
                targetElement.parents('li').addClass('active');
                targetElement.parents('li').parents('li').find('a').addClass('active');
                targetElement.parents('.nav-second-level').addClass('in');
            }
        }

        function similarity(s1, s2) {
            var longer = s1;
            var shorter = s2;
            if (s1.length < s2.length) {
                longer = s2;
                shorter = s1;
            }
            var longerLength = longer.length;
            if (longerLength == 0) {
                return 1.0;
            }
            return (longerLength - editDistance(longer, shorter)) / parseFloat(longerLength);
        }

        function editDistance(s1, s2) {
            s1 = s1.toLowerCase();
            s2 = s2.toLowerCase();

            var costs = new Array();
            for (var i = 0; i <= s1.length; i++) {
                var lastValue = i;
                for (var j = 0; j <= s2.length; j++) {
                    if (i == 0)
                        costs[j] = j;
                    else {
                        if (j > 0) {
                            var newValue = costs[j - 1];
                            if (s1.charAt(i - 1) != s2.charAt(j - 1))
                                newValue = Math.min(Math.min(newValue, lastValue),
                                    costs[j]) + 1;
                            costs[j - 1] = lastValue;
                            lastValue = newValue;
                        }
                    }
                }
                if (i > 0)
                    costs[s2.length] = lastValue;
            }
            return costs[s2.length];
        }
    }

    // =============== get the active sidebar ============//

    // scroll to table
    var filters = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        filters.push(hash[0]);
        filters[hash[0]] = hash[1];
    }
    if ((filters[0] == 'page' || window.location.href.indexOf('?') > 0) && $(".table").length > 0) {
        $("html, body").animate({
            scrollTop: $(".table").parents('.row').offset().top - 130
        }, "800", "swing");
    }

    // scroll to active li 
    if ($("#side-menu li.active").length > 0) {
        $(".slimscroll-menu").animate({
            scrollTop: $("#side-menu li.active").offset().top - 110
        }, "800", "swing");
    }

    // sidebar

    // search user

    if ($('.searchUser').length > 0) {


        $(".searchUser").select2({
            placeholder: window.i18n.common['searchUser'],
            language: {
                inputTooShort: function() {
                    return window.i18n.common['inputTooShort'];
                },
                searching: function() {
                    return window.i18n.common['searching'];
                }
            },
            ajax: {
                url: $('.searchUser').data('url'),
                method: 'POST',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term,
                        type: $('.searchUser').data('type')
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },

            },
            escapeMarkup: function(markup) { return markup; },
            minimumInputLength: 3,
            templateResult: formatUserResult,
            templateSelection: formatUserSelection

        });

        function formatUserResult(repo) {
            if (repo.loading) return repo.text;
            var markup =
                `<p class="my-3 p-2">` + repo.fullname + `</p>`;
            return markup;
        }

        function formatUserSelection(repo) {
            return repo.fullname || repo.text;
        }

        $(".select2-container").tooltip({
            title: function() {
                return $(this).prev().attr("title");
            },
            placement: "auto",
            trigger: "focus"
        });


    }

    // search user


    // convert link


    function hyphen(param, convert) {
        param = param.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '-').replace(/^(-)+|(-)+$/g, '-');
        clearTimeout(timer);
        timer = setTimeout(() => {
            checkLinkIsUnique(convert);
        }, 2000);
        return param;
    }

    $.each($('.baseName'), function(indexInArray, valueOfElement) {

        var name = $(this).attr('name');
        var convert = $(`.convert${capitalize(name)}ToLink`);

        if (convert.length > 0) {

            $(this).on("input", function() {
                convert.val(hyphen($(this).val().trim(), convert));
            });

            convert.on("input", function() {
                $(this).val(hyphen($(this).val(), $(this)));
            });

        }

    });




    function checkLinkIsUnique(convert) {
        if (convert.val().length <= 0) {
            return;
        }
        convertName = convert.attr('name');
        var params = {
            link: convert.val(),
            can: convert.data('can'),
            model: convert.data('model'),
            action: convert.data('action'),
            id: convert.data('id'),
        };

        $.ajax({
            type: "POST",
            url: baseAdminUrl + "/common/checkLinkIsUnique",
            data: params,
            success: function(response) {},
            error: function(xhr, response) {
                if (xhr.status == 422) {
                    toastr['warning'](window.i18n.validation.unique.replace(/:attribute/g, window.i18n.common[`${convertName}`]));
                }
            }
        });



    }


    // check mobile is unique

    $('.checkMobileIsUnique').on("input", function() {

        if ($(this).val().length <= 0) {
            return;
        }
        clearTimeout(timer);
        timer = setTimeout(() => {

            params = {
                mobile: $(this).val(),
                can: $(this).data("can"),
                model: $(this).data("model"),
                action: $(this).data("action"),
                id: $(this).data('id'),
            }

            $.ajax({
                type: "POST",
                url: baseAdminUrl + "/common/checkMobileIsUnique",
                data: params,
                success: function(response) {},
                error: function(xhr, response) {
                    if (xhr.status == 422) {
                        toastr['warning'](window.i18n.validation.unique.replace(/:attribute/g, window.i18n.common.mobile));
                    }
                }
            });

        }, 2000);

    });

    // check mobile is unique

    // check email is unique

    $('.checkEmailIsUnique').on("input", function() {

        if ($(this).val().length <= 0) {
            return;
        }
        clearTimeout(timer);
        timer = setTimeout(() => {

            params = {
                email: $(this).val(),
                can: $(this).data("can"),
                model: $(this).data("model"),
                action: $(this).data("action"),
                id: $(this).data('id'),
            }

            $.ajax({
                type: "POST",
                url: baseAdminUrl + "/common/checkEmailIsUnique",
                data: params,
                success: function(response) {},
                error: function(xhr, response) {
                    if (xhr.status == 422) {
                        toastr['warning'](window.i18n.validation.unique.replace(/:attribute/g, window.i18n.common.email));
                    }
                }
            });

        }, 2000);

    });

    // check email is unique

    // check username is unique

    $('.checkUsernameIsUnique').on("input", function() {

        if ($(this).val().length <= 0) {
            return;
        }
        clearTimeout(timer);
        timer = setTimeout(() => {

            params = {
                username: $(this).val(),
                can: $(this).data("can"),
                model: $(this).data("model"),
                action: $(this).data("action"),
                id: $(this).data('id'),
            }

            $.ajax({
                type: "POST",
                url: baseAdminUrl + "/common/checkUsernameIsUnique",
                data: params,
                success: function(response) {},
                error: function(xhr, response) {
                    if (xhr.status == 422) {
                        toastr['warning'](window.i18n.validation.unique.replace(/:attribute/g, window.i18n.common.username));
                    }
                }
            });

        }, 2000);

    });

    // check username is unique

    // meta-keywords-select
    $.each($('.meta-keywords-select'), function(indexInArray, valueOfElement) {

        var placeholder = $(this).data('placeholder');

        $(this).select2({
            placeholder: placeholder,
            tags: true,
        });

    });

    if ($('.meta-keywords-select').attr('title') != undefined) {
        $(".select2-container").tooltip({
            title: function() {
                return $(this).prev().attr("title");
            },
            placement: "auto",
            trigger: "focus"
        });
    }
    // meta-keywords-select

    // keywords-select
    $.each($('.keywords-select'), function(indexInArray, valueOfElement) {

        var placeholder = $(this).data('placeholder');

        $(this).select2({
            placeholder: placeholder,
            tags: true,

            language: {
                searching: function() {
                    return window.i18n.common['searching'];
                }
            },

            ajax: {
                url: baseAdminUrl + '/search/keyword',
                delay: 300,
                method: 'POST',
                processResults: function(data, page) {
                    return {
                        results: data
                    };
                }
            }


        });

    });

    if ($('.keywords-select').attr('title') != undefined) {
        $(".select2-container").tooltip({
            title: function() {
                return $(this).prev().attr("title");
            },
            placement: "auto",
            trigger: "focus"
        });
    }
    // keywords-select

    $('.selectLanguage').on('click', function() {
        $('#languageSelect .dropdown-menu a.active').removeClass('active');
        $(this).addClass('active');
        var img = $(this).find('img').attr('src');
        var name = $(this).find('span').html().trim();
        $('#selectedLanguageImage').attr('src', img);
        $('#selectedLanguageName').html(name + ' <i class="mdi mdi-chevron-down"></i> ');

        changeLanguage($(this).data('lang'));

    });

    $('.translate').on('click', function() {

        changeLanguage($(this).data('lang'), $(this).data('redirect'))

    });

    function changeLanguage(lang, redirect = null) {
        $.ajax({
            type: "POST",
            url: baseAdminUrl + '/config/language',
            data: "lang=" + lang,
            success: function(response) {
                if (redirect != null) {
                    window.location.href = redirect;
                } else {
                    window.location.reload();
                }
            },
            error: function(response) {

            }
        });
    }

    if ($('#map').length > 0) {
        loadMap();
    }

    function loadMap() {
        var latInput = $('input[name=lat]');
        var lngInput = $('input[name=lng]');

        const lat = parseFloat($('#map').data('lat'));
        const lng = parseFloat($('#map').data('lng'));

        const map = L.map('map', {
            scrollWheelZoom: true
        }).setView([lat, lng], parseInt($('#map').data('zoom'), 10));

        L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: `<a href="${$('#source_info').attr('href')}" target="_blank">${$('#source_info').html()}</a>`
        }).addTo(map);

        map.on('movestart', function(e) {
            $('.map-marker').addClass('active-marker');
        }).on('moveend', function() {
            $('.map-marker').removeClass('active-marker');

            latInput.val(map.getCenter().lat);
            lngInput.val(map.getCenter().lng);
        });
    }

    if ($('#showLocation').length > 0) {
        let location = {
            lat: $('#showLocation').data('lat'),
            lng: $('#showLocation').data('lng')
        };
        let map;
        map = L.map('showLocation', {
            center: [location.lat, location.lng],
            zoom: 16,
            drawControl: false
        });
        L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: `<a href="${$('#source_info').attr('href')}" target="_blank">${$('#source_info').html()}</a>`
        }).addTo(map);
        let marker = L.marker([location.lat, location.lng], {
            draggable: false
        });
        map.addLayer(marker);
    }



    // in view port event
    $.fn.isInViewport = function() {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };


    // set the user timezone
    timezone = moment.tz.guess();
    $.ajax({
        type: "POST",
        url: baseAdminUrl + "/config/timezone",
        data: {
            timezone: timezone
        },
        success: function(response) {
            document.cookie = `timezone=${timezone}; expires=Thu, 18 Dec 2113 12:00:00 UTC; path=/`;
        }
    });
    // set the user timezone

});