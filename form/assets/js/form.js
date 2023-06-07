jQuery(document).ready(function($) {


    // Codes https://en.wikipedia.org/wiki/List_of_North_American_Numbering_Plan_area_codes
    var stateCodes = '205, 251, 256, 334, 659, 938, 907, 236, 250, 778, 480, 520, 602, 623, 928, 327, 479, 501, 870, 209, 213, 279, 310, 323, 341, 408, 415, 424, 442, 510, 530, 559, 562, 619, 626, 628, 650, 657, 661, 669, 707, 714, 747, 760, 805, 818, 820, 831, 840, 858, 909, 916, 925, 949, 951, 303, 719, 720, 970, 983, 203, 475, 860, 959, 302, 202, 771, 239, 305, 321, 352, 386, 407, 448, 561, 656, 689, 727, 754, 772, 786, 813, 850, 863, 904, 941, 954, 229, 404, 470, 478, 678, 706, 762, 770, 912, 943, 808, 208, 986, 217, 224, 309, 312, 331, 447, 464, 618, 630, 708, 730, 773, 779, 815, 847, 872, 219, 260, 317, 463, 574, 765, 812, 930, 319, 515, 563, 641, 712, 316, 620, 785, 913, 270, 364, 502, 606, 859, 225, 318, 337, 504, 985, 207, 227, 240, 301, 410, 443, 667, 339, 351, 413, 508, 617, 774, 781, 857, 978, 231, 248, 269, 313, 517, 586, 616, 679, 734, 810, 906, 947, 989, 218, 320, 507, 612, 651, 763, 952, 228, 601, 662, 769, 314, 417, 557, 573, 636, 660, 816, 975, 406, 308, 402, 531, 702, 725, 775, 603, 201, 551, 609, 640, 732, 848, 856, 862, 908, 973, 505, 575, 212, 315, 332, 347, 516, 518, 585, 607, 631, 646, 680, 716, 718, 838, 845, 914, 917, 929, 934, 252, 336, 704, 743, 828, 910, 919, 980, 984, 701, 216, 220, 234, 283, 326, 330, 380, 419, 440, 513, 567, 614, 740, 937, 405, 539, 572, 580, 918, 458, 503, 541, 971, 215, 223, 267, 272, 412, 445, 484, 570, 582, 610, 717, 724, 814, 878, 401, 803, 839, 843, 854, 864, 605, 423, 615, 629, 731, 865, 901, 931, 210, 214, 254, 281, 325, 346, 361, 409, 430, 432, 469, 512, 682, 713, 726, 737, 806, 817, 830, 832, 903, 915, 936, 940, 945, 956, 972, 979, 385, 435, 801, 802, 276, 434, 540, 571, 703, 757, 804, 826, 948, 206, 253, 360, 425, 509, 564, 304, 681, 262, 274, 414, 534, 608, 715, 920, 307, 684, 671, 670, 787, 939, 340';


    $('.inpPhone').change(function() {
        var firstNum = $(this).val().substr(0, 2);
        if (firstNum != '+1') {
            $(this).val('');
        }
    });

    function inputPhoneMask() {
        [].forEach.call(document.querySelectorAll('.inpPhone'), function(input) {
            var keyCode;

            function mask(event) {
                event.keyCode && (keyCode = event.keyCode);
                var pos = this.selectionStart;
                if (pos < 3) event.preventDefault();
                var matrix = "+1 (___)-___-____",
                    i = 0,
                    def = matrix.replace(/\D/g, ""),
                    val = this.value.replace(/\D/g, ""),
                    new_value = matrix.replace(/[_\d]/g, function(a) {
                        return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                    });
                i = new_value.indexOf("_");
                if (i != -1) {
                    i < 5 && (i = 3);
                    new_value = new_value.slice(0, i)
                }
                var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                    function(a) {
                        return "\\d{1," + a.length + "}"
                    }).replace(/[+()]/g, "\\$&");
                reg = new RegExp("^" + reg + "$");
                if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                if (event.type == "blur" && this.value.length < 5) this.value = ""
            }

            input.addEventListener("input", mask, false);
            input.addEventListener("focus", mask, false);
            input.addEventListener("blur", mask, false);
            input.addEventListener("keydown", mask, false)

        });
    }
    inputPhoneMask();



    // Default select2
    $('.js-select2').select2();
    $('.select-inp.js-select2').change(function() {
        $(this).valid();
    });
    // select2 without search
    $('.js-select2-withoutSearch').select2({
        minimumResultsForSearch: -1
    });
    $('.select-inp.js-select2-withoutSearch').change(function() {
        $(this).valid();
    });


    // Global array for vehile template
    var tempArr = [2, 3, 4, 5, 6];

    // Click on "Remove" in vehicle form
    $('body').delegate("div.remove-btn", "click", function() {
        var tempId = Number($(this).parent().attr('temp-id'));
        tempArr.push(tempId);
        tempArr.sort();
        $(this).parent().remove();
    });

    // Form add another vehicle-END



    // Сlicking on select vehicle
    $('.select-vehicle__item').click(function() {

        // Variables
        const dataForm = $(this).attr('data-form');
        const selectVehicleTitle = $(this).find('.select_vehicle_title').attr('data-title');
        const vehicleTitle = $('#vehicle_title');

        $('#' + dataForm + ' input[name="vehicle_type"]').val(selectVehicleTitle);

        // Change the title
        vehicleTitle.text(selectVehicleTitle);

        // Add vehicle name
        $('.selected_transport').text(selectVehicleTitle)

        // Show the desired form
        $('#' + dataForm).fadeIn();

        // Initilization step-form 
        app.init(dataForm);

        // Hide select-vehicle
        $('.select-vehicle').fadeOut();

        // Remove other form
        $('.multi-step-form').not('#' + dataForm).remove();

        // If form3 - remove boat check_wrapper or other check_wrapper
        if (selectVehicleTitle == 'Boat') {
            $('.check_wrapper_other').remove();
        } else {
            $('.check_wrapper_boat').remove();
        }
    });


    // Focus select-input 
    $('.select-inp input').focus(function() {
        $(this).parent().addClass('active');
    });
    // Focusout select-input 
    $('.select-inp input').focusout(function() {
        $(this).parent().removeClass('active');
    });


    // Datepicker
    var specificDateClass = ".datepicker";
    var flexibleDateClass = ".datepicker-flex";

    $(specificDateClass).datepicker({
        minDate: 0,
        onSelect: function(date) {
            $('.datepicker_value').val(date);
            $(specificDateClass).fadeOut();
        }
    });
    $(specificDateClass).find(".ui-datepicker-current-day").removeClass("ui-datepicker-current-day");


    $(flexibleDateClass).datepicker({
        minDate: 0,
        onSelect: function(date) {
            $('.datepicker-flex_value').val(date);
            $(flexibleDateClass).fadeOut();
        }
    });
    $(flexibleDateClass).find(".ui-datepicker-current-day").removeClass("ui-datepicker-current-day");

    // Don't translate (Google Translate)
    $('.ui-datepicker').addClass('notranslate');


    function shipDate() {
        var inpShipDate = $('input[name="ship_date"]:checked');
        switch (inpShipDate.attr('id')) {
            case "specific_date":
                $(specificDateClass).fadeIn();
                $(flexibleDateClass).css('display', 'none');

                $('.datepicker-inp').css('display', 'none');
                $('.datepicker-inp[name="when_date"]').css('display', 'block');
                break;

            case "flexible_date":
                $(flexibleDateClass).fadeIn();
                $(specificDateClass).css('display', 'none');

                $('.datepicker-inp').css('display', 'none');
                $('.datepicker-inp[name="flex_date"]').css('display', 'block');
                break;

            default:
                $(specificDateClass).css('display', 'none');
                $(flexibleDateClass).css('display', 'none');

                $('.datepicker-inp').css('display', 'none');
        }
    }
    shipDate();

    $('input[name="ship_date"]').click(function() {
        shipDate();
    });



    // Массив фековых номеров
    var arrFakePhone = [];
    // Массив фековых emails
    var arrFakeEmail = [];
    // Массив последних цифр телефона
    var arrLastDigitsPhone = [];

    jQuery.post(ajax_call.ajaxurl, { action: 'get_fake_data' }).done(function(response) {
        var result = JSON.parse(response);
        if (result.fake_phone.length > 0) arrFakePhone = result.fake_phone.split('\r\n');
        if (result.fake_email.length > 0) arrFakeEmail = result.fake_email.split('\r\n');
        if (result.last_phone.length > 0) arrLastDigitsPhone = result.last_phone.split('\r\n');
    });



    // Steps form
    var app = {

        init: function(parentId) {
            this.cacheDOM(parentId);
            this.setupAria();
            this.nextButton();
            this.addButton();
            this.prevButton();
            this.validateForm();
            this.killEnterKey();
        },

        cacheDOM: function(parentId) {
            if ($("#" + parentId).size() === 0) { return; }
            this.$formParent = $("#" + parentId);
            this.$form = this.$formParent.find("form");
            this.$formStepParents = this.$form.find(".step-block");
            this.$nextButton = this.$form.find(".btn-next");
            this.$addButton = this.$form.find(".add_btn");
            this.$prevButton = this.$form.find(".btn-prev");
        },

        htmlClasses: {
            activeClass: "active",
            hiddenClass: "hidden",
            visibleClass: "visible",
            animatedVisibleClass: "animated fadeIn",
            animatedHiddenClass: "animated fadeOut",
            animatingClass: "animating"
        },

        setupAria: function() {

            // set first parent to visible
            this.$formStepParents.eq(0).attr("aria-hidden", false);

            // set all other parents to hidden
            this.$formStepParents.not(":first").attr("aria-hidden", true);

            // handle aria-expanded on next/prev buttons
            app.handleAriaExpanded();

        },

        nextButton: function() {

            this.$nextButton.on("click", function(e) {

                e.preventDefault();

                // grab current step and next step parent
                var $this = $(this),
                    currentParent = $this.closest(".step-block"),
                    nextParent = currentParent.next();

                $('html, body').stop().animate({
                    scrollTop: currentParent.offset().top - 60
                }, 800);



                // if the form is valid hide current step
                // trigger next step
                if (app.checkForValidForm()) {

                    if ($this.hasClass('zip_btn_next')) {
                        const inputZip1 = $('#zip1');
                        const inputZip1Data = inputZip1.val().split(' : ');
                        const inputZip2 = $('#zip2');
                        const inputZip2Data = inputZip2.val().split(' : ');

                        function functionZip1(callback) {
                            $('#form_loader').addClass('active');
                            var checkCity = {
                                action: 'check_city',
                                data: inputZip1Data,
                            };
                            jQuery.post(ajax_call.ajaxurl, checkCity).done(function(data) {
                                if (data == true) {
                                    inputZip1.removeClass('error-text');
                                    callback();
                                } else {
                                    inputZip1.addClass('error-text');
                                    $('label[for="' + $(inputZip1).attr('data-id') + '"]').addClass('info-active');
                                    $('#form_loader').removeClass('active');
                                }
                            });
                        }

                        function functionZip2(callback) {
                            var checkCity = {
                                action: 'check_city',
                                data: inputZip2Data,
                            };
                            jQuery.post(ajax_call.ajaxurl, checkCity).done(function(data) {
                                if (data == true) {
                                    inputZip2.removeClass('error-text');
                                    callback();
                                } else {
                                    inputZip2.addClass('error-text');
                                    $('label[for="' + $(inputZip2).attr('id') + '"]').addClass('info-active');
                                    $('#form_loader').removeClass('active');
                                }
                            });
                        }

                        function functionZipCheck() {
                            if (!inputZip1.hasClass('error-text')) {
                                functionZip2(functionZipCheck2);
                            }
                        }

                        function functionZipCheck2() {
                            if (!inputZip2.hasClass('error-text')) {
                                $('#form_loader').removeClass('active');
                                currentParent.removeClass(app.htmlClasses.visibleClass);
                                app.showNextStep(currentParent, nextParent);
                            }
                        }

                        functionZip1(functionZipCheck);

                    } else {
                        currentParent.removeClass(app.htmlClasses.visibleClass);
                        app.showNextStep(currentParent, nextParent);
                    }
                }

            });
        },

        addButton: function() {
            this.$addButton.on("click", function(e) {

                e.preventDefault();

                var tempInputs = $(this).closest(".multi-step-form").find('.temp-inputs:first-child');
                tempInputs = tempInputs.clone();
                var tempContainer = $(this).closest(".multi-step-form").find('.temp-container');
                var tempQuantity = tempContainer.find('.temp-inputs');

                if (tempQuantity.length < 6) {
                    tempInputs.attr('temp-id', tempArr[0]);
                    tempInputs.find('input').each(function() {

                        // Name
                        if ($(this).attr('name')) {
                            var inpName = $(this).attr('name').slice(0, -1);
                            $(this).attr('name', inpName + tempArr[0]);
                        }

                        // Value
                        if ($(this).attr('type') != 'radio') {
                            $(this).val('');
                        }

                        // Id
                        if ($(this).attr('id')) {
                            var inpId = $(this).attr('id').slice(0, -1);
                            $(this).attr('id', inpId + tempArr[0]);
                        }

                        // List
                        if ($(this).attr('list')) {
                            var inpList = $(this).attr('list').slice(0, -1);
                            $(this).attr('list', inpList + tempArr[0]);
                        }

                        // Select other
                        if ($(this).parent().attr('id')) {
                            var inpParentId = $(this).parent().attr('id').slice(0, -1);
                            $(this).parent().attr('id', inpParentId + tempArr[0]);
                        }

                        // Select other arrow
                        if ($(this).next().attr('data-id')) {
                            var dataId = $(this).next().attr('data-id').slice(0, -1);
                            $(this).next().attr('data-id', dataId + tempArr[0]);
                        }

                    });

                    // Select
                    tempInputs.find('select').each(function() {
                        var selectName = $(this).attr('name').slice(0, -1);
                        $(this).attr('name', selectName + tempArr[0]);

                        if ($(this).attr('id')) {
                            var selectId = $(this).attr('id').slice(0, -1);
                            $(this).attr('id', selectId + tempArr[0]);
                        }

                    });

                    // Option
                    tempInputs.find('option').each(function() {
                        if ($(this).attr('data-inp')) {
                            var optionDataInp = $(this).attr('data-inp').slice(0, -1);
                            $(this).attr('data-inp', optionDataInp + tempArr[0]);
                        }
                        if ($(this).attr('data-model')) {
                            var optionDataModel = $(this).attr('data-model').slice(0, -1);
                            $(this).attr('data-model', optionDataModel + tempArr[0]);
                        }
                        if ($(this).attr('data-inp-model')) {
                            var optionDataInpModel = $(this).attr('data-inp-model').slice(0, -1);
                            $(this).attr('data-inp-model', optionDataInpModel + tempArr[0]);
                        }

                    });

                    // Datalist
                    tempInputs.find('datalist').each(function() {
                        var datalistId = $(this).attr('id').slice(0, -1);
                        $(this).attr('id', datalistId + tempArr[0]);
                    });

                    // Label
                    tempInputs.find('label').each(function() {
                        var labelFor = $(this).attr('for').slice(0, -1);
                        $(this).attr('for', labelFor + tempArr[0]);
                    });

                    tempInputs.appendTo(tempContainer);

                    if ($(this).closest(".multi-step-form").attr('id') == 'form1') {
                        selectMake('select_make-' + tempArr[0], 'select_model-' + tempArr[0], tempArr[0]);
                        selectOther();

                        if ($('#select_make_inp-' + tempArr[0]).length > 0) {
                            $('#select_make_inp-' + tempArr[0]).find('.select_other_make').trigger('click');
                        }
                    }


                    // select_year
                    if ($('#s2id_select_year-' + tempArr[0]).length > 0) {
                        $('#s2id_select_year-' + tempArr[0]).remove();
                        $('#select_year-' + tempArr[0]).select2();
                    }
                    // vehicle_year
                    if ($('#s2id_vehicle_year-' + tempArr[0]).length > 0) {
                        $('#s2id_vehicle_year-' + tempArr[0]).remove();
                        $('#vehicle_year-' + tempArr[0]).select2();
                    }
                    // select_make
                    if ($('#s2id_select_make-' + tempArr[0]).length > 0) {
                        $('#s2id_select_make-' + tempArr[0]).remove();
                        $('#select_make-' + tempArr[0]).select2();
                    }
                    // select_model
                    if ($('#s2id_select_model-' + tempArr[0]).length > 0) {
                        $('#s2id_select_model-' + tempArr[0]).remove();
                        $('#select_model-' + tempArr[0]).select2();
                    }

                    $('.select-inp.js-select2').change(function() {
                        $(this).valid();
                    });
                    $('.select-inp.js-select2-withoutSearch').change(function() {
                        $(this).valid();
                    });


                    tempArr.splice(0, 1);

                } else {
                    alert('Sorry, this is the maximum');
                }

            });

        },

        prevButton: function() {

            this.$prevButton.on("click", function(e) {

                e.preventDefault();

                // grab current step parent and previous parent
                var $this = $(this),
                    currentParent = $(this).closest(".step-block"),
                    prevParent = currentParent.prev();

                // hide current step and show previous step
                // no need to validate form here
                currentParent.removeClass(app.htmlClasses.visibleClass);
                app.showPrevStep(currentParent, prevParent);

            });
        },

        showNextStep: function(currentParent, nextParent) {

            // hide previous parent
            currentParent
                .addClass(app.htmlClasses.hiddenClass)
                .attr("aria-hidden", true);

            // show next parent
            nextParent
                .removeClass(app.htmlClasses.hiddenClass)
                .addClass(app.htmlClasses.visibleClass)
                .attr("aria-hidden", false);

            // focus first input on next parent
            nextParent.focus();

            // handle aria-expanded on next/prev buttons
            app.handleAriaExpanded();

        },

        showPrevStep: function(currentParent, prevParent) {

            // hide previous parent
            currentParent
                .addClass(app.htmlClasses.hiddenClass)
                .attr("aria-hidden", true);

            // show next parent
            prevParent
                .removeClass(app.htmlClasses.hiddenClass)
                .addClass(app.htmlClasses.visibleClass)
                .attr("aria-hidden", false);

            // send focus to first input on next parent
            prevParent.focus();

            // handle aria-expanded on next/prev buttons
            app.handleAriaExpanded();

        },

        handleAriaExpanded: function() {

            $.each(this.$nextButton, function(idx, item) {
                var controls = $(item).attr("aria-controls");
                if ($("#" + controls).attr("aria-hidden") == "true") {
                    $(item).attr("aria-expanded", false);
                } else {
                    $(item).attr("aria-expanded", true);
                }
            });

            $.each(this.$prevButton, function(idx, item) {
                var controls = $(item).attr("aria-controls");
                if ($("#" + controls).attr("aria-hidden") == "true") {
                    $(item).attr("aria-expanded", false);
                } else {
                    $(item).attr("aria-expanded", true);
                }
            });

        },

        validateForm: function() {

            // Checking the value in select-input
            jQuery.validator.addMethod("checkData", function(value, element) {
                var list = $(element).attr('list');
                var datalistOptions = $('#' + list + ' option');
                var datalistArr = [];
                for (var i = 0; i < datalistOptions.length; i++) {
                    datalistArr[i] = $(datalistOptions[i]).val();
                    if (value == $(datalistOptions[i]).val()) {
                        return true;
                    }
                }
                return false;
            });

            // Checking the value in move-input
            jQuery.validator.addMethod("checkMove", function(value, element) {
                var expression = new RegExp('^[0-9]{5} [:]{1} [A-Z]{1}');
                if (expression.test(value)) {
                    return true;
                }
                return false;
            });

            // Правило, что не могут вводиться одинаковые значения для адреса доставки и отправки
            jQuery.validator.addMethod("checkVal", function(value, element) {
                var pickup_val = $('#zip1').val().replace(/\s+/g, '');
                var delivery_val = $('#zip2').val().replace(/\s+/g, '');

                if (pickup_val == delivery_val) {
                    return false;
                }
                return true;
            });

            // Checking the value in phone-input
            jQuery.validator.addMethod("checkPhone", function(value, element) {
                var arrCodes = stateCodes.split(', ');
                if (arrCodes.includes(value.substring(4, 7)) && value.substr(0, 2) == '+1') {
                    return true;
                }
                return false;
            });


            // Проверка телефона на фейковый
            jQuery.validator.addMethod("checkPhoneFake", function(value, element) {
                // Перебераем массив фейковых номеров
                for (var i = arrFakePhone.length - 1; i >= 0; i--) {
                    // Если елемент массива совпадает с данным телефоном из формы
                    if (arrFakePhone[i] === value) {
                        // Возвращаем false
                        return false;
                    }
                }
                return true;
            });

            // Проверка emails на фейк
            jQuery.validator.addMethod("checkEmailFake", function(value, element) {
                // Перебераем массив фейковых номеров
                for (var i = arrFakeEmail.length - 1; i >= 0; i--) {
                    // Если елемент массива совпадает с данным телефоном из формы
                    if (arrFakeEmail[i] === value) {
                        // Возвращаем false
                        return false;
                    }
                }
                return true;
            });

            // Проверка последних цифр у телефона
            jQuery.validator.addMethod("checkDigitsPhone", function(value, element) {
                // Перебераем массив последних цифр телефона
                for (var i = arrLastDigitsPhone.length - 1; i >= 0; i--) {
                    // Последние цифры телефона
                    var lastword = value.toString().slice(-8);

                    // Если елемент массива совпадает с последними цифрами телефона
                    if (arrLastDigitsPhone[i] == lastword) {
                        // Возвращаем false
                        return false;
                    }
                }
                return true;
            });

            // Проверка последних цифр у телефона
            jQuery.validator.addMethod("checkFormatEmail", function(value, element) {
                var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (!filter.test(value)) {
                    return false;
                }
                return true;
            });

            jQuery.validator.addClassRules("rule-select", {
                checkData: true
            });


            // jquery validate form validation
            this.$form.validate({
                rules: {
                    pickup_city: {
                        checkMove: true,
                        checkVal: true,
                    },
                    delivery_city: {
                        checkMove: true,
                        checkVal: true,
                    },
                    phone: {
                        checkPhone: true,
                        checkPhoneFake: true,
                        checkDigitsPhone: true,
                    },
                    email: {
                        checkEmailFake: true,
                        checkFormatEmail: true,
                    }
                },
                ignore: ":hidden", // any children of hidden desc are ignored
                errorElement: "span", // wrap error elements in span not label
                errorClass: "error-text", // Sarah added error class to span
                errorPlacement: function(error, element) {
                    error.remove();
                },

                invalidHandler: function(event, validator) { // add aria-invalid to el with error
                    $.each(validator.errorList, function(idx, item) {
                        if (idx === 0) {
                            $(item.element).focus(); // send focus to first el with error
                        }
                        $(item.element).attr("aria-invalid", true); // add invalid aria
                    })
                },
                submitHandler: function(form) {


                    // Show loader
                    $('#form_loader').addClass('active');


                    var result = [];
                    // Берем все данные с формы
                    var dataForm = $(form).serializeArray();

                    // Перебераем массив
                    for (var i = 0; i < dataForm.length; i++) {
                        // В массив result заносим элемент 
                        result[dataForm[i]['name']] = dataForm[i]['value'];
                    };

                    // Phone
                    var inputPhone = '+1' + String(result['phone']).substring(2);



                    // -- Переменные --
                    // Имя
                    var strFullName = result['full_name'],
                        full_name = strFullName.split(" "),
                        firstName = full_name.shift(),
                        lastName = full_name.join(' '),
                        // Поля доставки 
                        pickup_city = result['pickup_city'],
                        delivery_city = result['delivery_city'],

                        // Origin
                        // Разбиваем строку
                        origin = pickup_city.split(" : "),
                        // Разбиваем строку
                        originSityAndState = origin[1].split(", "),

                        // Moving
                        moving = delivery_city.split(" : "),
                        // Разбиваем строку
                        movingSityAndState = moving[1].split(", "),

                        movedate = '',
                        customerNotes = '';

                    // Дата
                    switch (result['ship_date']) {
                        case "specific_date":
                            movedate = result['when_date'];
                            customerNotes = 'Specific date';
                            break;
                        case "flexible_date":
                            movedate = result['flex_date'];
                            customerNotes = 'I`am flexible';
                            break;
                        case "asap_date":
                            dateTime = new Date().toLocaleString("en-US", { timeZone: "America/New_York", year: 'numeric', month: '2-digit', day: '2-digit' }).split(',')[0];
                            movedate = dateTime.replace(/[ ,.-]/g, '/');
                            customerNotes = 'ASAP';
                            break;
                    }

                    
                    // Url страницы
                    var pageUrl = window.location.href;
                    // Если есть url с которого пришел пользователь
                    if (document.referrer != '') {
                        pageUrl = document.referrer;
                    }

                    var leadData = {
                        key: "insert_key",
                        lead: {
                            campid: "insert_campid",
                            sid: '1',
                            ssid: '',
                            page_url: pageUrl,
                            email: result['email'],
                            firstname: firstName,
                            lastname: lastName,
                            phone1: inputPhone,
                            origincity: originSityAndState[0],
                            originstate: originSityAndState[1],
                            originzip: origin[0],
                            movedate: movedate,
                            customerNotes: customerNotes,
                            movingcity: movingSityAndState[0],
                            movingstate: movingSityAndState[1],
                            movingzip: moving[0],
                            utm_source: '',
                            utm_medium: '',
                            utm_campaign: '',
                            utm_content: '',
                            utm_term: ''
                        },
                    };

                    // Массив
                    var vehicleKeys = [];
                    // Цикл
                    for (var i = 1; i <= 6; i++) {
                        // Если в "result" есть данное значение
                        if (result['vehicle_year-' + i]) {
                            // Заносим "i" в массив "vehicleKeys"
                            vehicleKeys.push(i);
                        }
                    }

                    // Объект
                    vehicleData = {}
                        // Перебераем "vehicleKeys"
                    for (var i = vehicleKeys.length - 1; i >= 0; i--) {
                        var vehicle_index = i + 1;


                        // Make inp
                        if (result['inp_vehicle_make-' + vehicleKeys[i]] && result['inp_vehicle_make-' + vehicleKeys[i]].length > 0) {
                            result['vehicle_make-' + vehicleKeys[i]] = result['inp_vehicle_make-' + vehicleKeys[i]];
                        }

                        // Model inp
                        if (result['inp_vehicle_model-' + vehicleKeys[i]] && result['inp_vehicle_model-' + vehicleKeys[i]].length > 0) {
                            result['vehicle_model-' + vehicleKeys[i]] = result['inp_vehicle_model-' + vehicleKeys[i]];
                        }


                        // Эти поля для всех типов транспорта
                        vehicleData['vehiclemake' + vehicle_index] = result['vehicle_make-' + vehicleKeys[i]];
                        vehicleData['vehiclemodel' + vehicle_index] = result['vehicle_model-' + vehicleKeys[i]];
                        vehicleData['vehicleyear' + vehicle_index] = result['vehicle_year-' + vehicleKeys[i]];

                        // transport_type
                        if (result['trailer_type-' + vehicleKeys[i]] == 'Enclosed') {
                            vehicleData['transport_type' + vehicle_index] = 2;
                        } else {
                            vehicleData['transport_type' + vehicle_index] = 1;
                        }


                        if (result['form_type'] == 'form_type_3') { // Trailer, Boat, Truck, Forklift, Heavy Equipment

                            vehicleData['length' + vehicle_index] = result['length_ft-' + vehicleKeys[i]] + 'Ft ' + result['length_in-' + vehicleKeys[i]] + 'In';
                            vehicleData['width' + vehicle_index] = result['width_ft-' + vehicleKeys[i]] + 'Ft ' + result['width_in-' + vehicleKeys[i]] + 'In';
                            vehicleData['height' + vehicle_index] = result['height_ft-' + vehicleKeys[i]] + 'Ft ' + result['height_in-' + vehicleKeys[i]] + 'In';
                            vehicleData['weigth' + vehicle_index] = result['weigth_lbs-' + vehicleKeys[i]] + 'Lbs';
                            vehicleData['vehicle_weight' + vehicle_index] = parseInt(result['weigth_lbs-' + vehicleKeys[i]]);


                            if (result['vehicle_type'] == 'Boat') { //Когда тип транспорта == "Boat"
                                // istrailer
                                vehicleData['istrailer' + vehicle_index] = result['is_trailer-' + vehicleKeys[i]];

                                // vehicle_inop
                                if (result['is_trailer-' + vehicleKeys[i]] == 'Yes') {
                                    vehicleData['vehicle_inop' + vehicle_index] = 1;
                                } else {
                                    vehicleData['vehicle_inop' + vehicle_index] = 0;
                                }
                            } else { //Остальной транспорт
                                // doesnotrun
                                vehicleData['doesnotrun' + vehicle_index] = result['is_operable-' + vehicleKeys[i]];

                                // vehicle_inop
                                if (result['is_operable-' + vehicleKeys[i]] == 'Yes') {
                                    vehicleData['vehicle_inop' + vehicle_index] = 1;
                                } else {
                                    vehicleData['vehicle_inop' + vehicle_index] = 0;
                                }
                            }

                        } else { // Car, Motorcycle, ATV/UTV, Snowmobile

                            // trailertype
                            vehicleData['trailertype' + vehicle_index] = result['trailer_type-' + vehicleKeys[i]];
                            // doesnotrun
                            vehicleData['doesnotrun' + vehicle_index] = result['does_run-' + vehicleKeys[i]];

                            // vehicle_inop
                            if (result['does_run-' + vehicleKeys[i]] == 'Yes') {
                                vehicleData['vehicle_inop' + vehicle_index] = 1;
                            } else {
                                vehicleData['vehicle_inop' + vehicle_index] = 0;
                            }
                        }

                        // Поля vehicle_type, vehicletype
                        switch (result['vehicle_type']) {
                            case 'Car':
                                vehicleData['vehicle_type' + vehicle_index] = 'Car';
                                vehicleData['vehicletype' + vehicle_index] = 'car';
                                break;
                            case 'Motorcycle':
                                vehicleData['vehicle_type' + vehicle_index] = 'Motorcycle';
                                vehicleData['vehicletype' + vehicle_index] = 'motorcycle';
                                break;
                            case 'Boat':
                                vehicleData['vehicle_type' + vehicle_index] = 'Boat';
                                vehicleData['vehicletype' + vehicle_index] = 'boat';
                                break;
                            case 'Trailer':
                                vehicleData['vehicle_type' + vehicle_index] = 'Other';
                                vehicleData['vehicletype' + vehicle_index] = 'rv_trailer';
                                break;
                            case 'ATV/UTV':
                                vehicleData['vehicle_type' + vehicle_index] = 'Other';
                                vehicleData['vehicletype' + vehicle_index] = 'atv_utv';
                                break;
                            case 'Truck':
                                vehicleData['vehicle_type' + vehicle_index] = 'Other';
                                vehicleData['vehicletype' + vehicle_index] = 'truck';
                                break;
                            case 'Forklift':
                                vehicleData['vehicle_type' + vehicle_index] = 'Other';
                                vehicleData['vehicletype' + vehicle_index] = 'other';
                                break;
                            case 'Snowmobile':
                                vehicleData['vehicle_type' + vehicle_index] = 'Other';
                                vehicleData['vehicletype' + vehicle_index] = 'snowmobile';
                                break;
                            case 'Heavy Equipment':
                                vehicleData['vehicle_type' + vehicle_index] = 'Other';
                                vehicleData['vehicletype' + vehicle_index] = 'heavy_equipment';
                                break;
                        }

                    }

                    // Заносим массив "vehicleData" в нужный массив "leadData"
                    for (var key in vehicleData) {
                        leadData.lead[key] = vehicleData[key];
                    }

                    var actionData = {
                        action: 'get_data',
                    };

                    jQuery.post(ajax_call.ajaxurl, actionData).done(function(result) {
                        result = JSON.parse(result);

                        // UTM
                        if (result.utm) {
                            for (var key in result.utm) {
                                leadData.lead[key] = result.utm[key];
                            }
                        }

                        // SID
                        if (result.sid) {
                            leadData.lead['sid'] = result.sid;
                        }

                        $.ajax({
                            url: 'https://comparethecarrier.leadbyte.com/restapi/v1.2/leads',
                            type: "POST",
                            dataType: 'json',
                            data: leadData,
                        });

                        leadToAdmin();
                    });


                    function leadToAdmin() {
                        var dataLeads = {
                            action: 'leads_to_admin',
                            data: leadData['lead'],
                        };
                        jQuery.post(ajax_call.ajaxurl, dataLeads).done(function(data) {
                            // Hide loader
                            $('#form_loader').removeClass('active');

                            $('.form-success').fadeIn();

                            setTimeout(function() {
                                location.reload();
                                window.scrollTo(0, 0);
                            }, 4000);
                        });
                    }


                    return false;
                }
            });
        },

        checkForValidForm: function() {
            if (this.$form.valid()) {
                return true;
            }
        },

        killEnterKey: function() {
            $(document).on("keypress", ":input:not(textarea,button)", function(event) {
                return event.keyCode != 13;
            });
        },
    };


    function selectMake(idSelect, idModel, numberItem) {
        var selectMake = $('#' + idSelect);
        var selectModel = $('#' + idModel);

        selectMake.change(function(event, updateModel) {

            var selectMakeVal = $(this).val();

            // Если выбрали 'other'
            if (selectMakeVal == 'other') {

                // Получаем id инпута который нужно показать для Make
                var makeInputId = $(this).find(':selected').attr('data-inp');
                // Получаем id инпута который нужно показать для Model
                var modelInputId = $(this).find(':selected').attr('data-inp-model');
                // Получаем id селекта который нужно скрыть для Model
                var modelId = $(this).find(':selected').attr('data-model');

                // Скрываем родительский элемент селекта make
                $(this).parent().addClass('hide');
                // Скрываем родительский элемент селекта model
                $('#' + modelId).parent().addClass('hide');

                // Показываем инпут make
                $('#' + makeInputId).removeClass('hide');
                // Показываем инпут model
                $('#' + modelInputId).removeClass('hide');

                return true;
            }

            if (updateModel != false) {

                // Показываем загрузку
                var selectParent = selectModel.parent();
                selectParent.addClass('show_select_load');

                selectModel.html('<option value="" disabled="" selected=""></option>');

                var data = {
                    action: 'select_model',
                    vehicle: selectMakeVal,
                }

                jQuery.post(ajax_call.ajaxurl, data, function(response) {
                    selectModel.html('<option value="" disabled="" selected=""></option>');
                    selectModel.append(response);
                    selectModel.append('<option value="other" data-inp="' + idModel.slice(0, -2) +
                        '_inp-' + numberItem + '">Other</option>');
                    selectParent.removeClass('show_select_load');
                    selectModel.trigger('change');
                    selectModel.removeClass('error-text');
                });
            }
        });

        selectModel.change(function() {
            if ($(this).val() == 'other') {
                // Получаем id инпута который нужно показать для Model
                var modelInputId = $(this).find(':selected').attr('data-inp');
                // Скрываем родительский элемент селекта make
                $(this).parent().addClass('hide');
                // Показываем инпут model
                $('#' + modelInputId).removeClass('hide');
            }
        });
    }
    selectMake('select_make-1', 'select_model-1', 1);



    function selectOther() {
        $('.select_other_make').click(function() {
            var dataId = $(this).attr('data-id');
            makeSelect(dataId);
            modelSelect(dataId);
        });
        $('.select_other_model').click(function() {
            var dataId = $(this).attr('data-id');
            modelSelect(dataId);
            if ($('#select_make-' + dataId).parent().hasClass('hide')) {
                makeSelect(dataId);
            }
        });
    }
    selectOther();



    // Показываем select make - скрываем input make
    function makeSelect(vehicle_number) {
        $('#select_make_inp-' + vehicle_number).addClass('hide');
        $('#select_make_inp-' + vehicle_number + ' input').val('');
        $('#select_make-' + vehicle_number).parent().removeClass('hide');
        $('#select_make-' + vehicle_number).val('');
        $('#select_make-' + vehicle_number).trigger('change');
    }

    // Показываем select model - скрываем input model
    function modelSelect(vehicle_number) {
        $('#select_model_inp-' + vehicle_number).addClass('hide');
        $('#select_model_inp-' + vehicle_number + ' input').val('');
        $('#select_model-' + vehicle_number).parent().removeClass('hide');
        $('#select_model-' + vehicle_number).val('');
        $('#select_model-' + vehicle_number).trigger('change');
    }




    $('.ui-autocomplete-input').autocomplete({
        position: {
            my: "left+0 top+4",
        },
        source: function(request, response) {
            var data = {
                action: 'search_city',
                zip_list: request.term,
            };

            jQuery.post(ajax_call.ajaxurl, data, function(dataCities) {
                response(JSON.parse(dataCities));
            });
        }
    });



    // Info
    $('.info').click(function() {
        $(this).closest('label').addClass('info-active');
    });

    $('.btn-next').click(function() {
        var errorInp = $(this).parent().parent().find('input');
        setTimeout(function() {
            errorInp.each(function(index, item) {
                if ($(item).hasClass('error-text')) {
                    $('label[for="' + $(item).attr('id') + '"]').addClass('info-active');
                }
            });
        }, 100);
    });


    $('button[type="submit"]').click(function() {
        var errorInp = $(this).parent().parent().find('input');
        setTimeout(function() {
            errorInp.each(function(index, item) {
                if ($(item).hasClass('error-text')) {
                    $('label[for="' + $(item).attr('id') + '"]').addClass('info-active');
                }
            });
        }, 100);
    });


    $(document).mouseup(function(e) {
        var elem = $(".info");
        if (!elem.is(e.target) &&
            elem.has(e.target).length === 0) {
            elem.closest('label').removeClass('info-active');
        }
    });


    $('.input-info').keyup(function() {
        if ($(this).hasClass('error-text')) {
            $('label[for="' + $(this).attr('id') + '"]').addClass('info-active');
        }
    });

    // Info-END


});
