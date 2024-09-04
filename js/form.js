"use strict";

$(document).ready(function() {
    let validateForm = function() {
        let formTel = $("#register-form-tel");
        let formSite = $("#register-form-site");
        let formName = $("#register-form-name");

        const digitsOnlyPattern = /^\d+$/;
        const urlPattern = new RegExp('^(https?:\\/\\/)?'   + // проверка протокола
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'  + // проверка имени домена
            '((\\d{1,3}\\.){3}\\d{1,3}))'                       + // проверка ip адреса 
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'                   + // проверка порта и пути
            '(\\?[;&a-z\\d%_.~+=-]*)?'                          + // проверка параметров запроса
            '(\\#[-a-z\\d_]*)?$','i');                            // проверка хэша

        function validateName() { // Проверка имени
            if ($(formName).val() == "") {
                $(formName).parents(".register-form__group").find(".hidden").show();
                $(formName).parents(".register-form__group").find(".register-form__help-block").text("Надо заполнить имя");
                return false;
            } else {
                $(formName).parents(".register-form__group").find(".hidden").hide();
                $(formName).parents(".register-form__group").find(".register-form__help-block").text();
                return true;
            }
        }

        function validateSite() { // Проверка сайта
            let formSiteValue = $(formSite).val();
            if (formSiteValue == "") {
                $(formSite).parents(".register-form__group").find(".hidden").show();
                $(formSite).parents(".register-form__group").find(".register-form__help-block").text("Надо ввести сайт");
                return false;
            } else if(!urlPattern.test(formSiteValue)) {
                $(formSite).parents(".register-form__group").find(".register-form__help-block").text("Введен неверный сайт");
                return false;
            } else {
                $(formSite).parents(".register-form__group").find(".hidden").hide();
                $(formSite).parents(".register-form__group").find(".register-form__help-block").text();
                return true;
            }
        }

        function validateTel() {  // Проверка телефона
            let formTelValue = $(formTel).val();
            if (formTelValue == "") {
                $(formTel).parents(".register-form__group").find(".hidden").show();
                $(formTel).parents(".register-form__group").find(".register-form__help-block").text("Надо ввести номер телефона");
                return false;
            }  else if(!digitsOnlyPattern.test(formTelValue)) {
                $(formTel).parents(".register-form__group").find(".register-form__help-block").text("Это не телефонный номер");
                return false;
            } else {
                $(formTel).parents(".register-form__group").find(".hidden").hide();
                $(formTel).parents(".register-form__group").find(".register-form__help-block").text();
                return true;
            }
        }

        function validateCheckbox() {  // Проверка чекбокса и подсветка текста при ошибке
            if (!$('.register-form-agree__checkbox').is(":checked")) {
                $(".register-form-agree__text").each(function() {
                    $(this).addClass("register-form-agree__text_animated");
                    setTimeout (function() {
                        $(this).removeClass('register-form-agree__text_animated');
                    }.bind(this), 2000);
                });

                return false;
            } else {
                $(".register-form-agree__text").removeClass("register-form-agree__text_animated");
                return true;
            }
        }



        validateName();
        validateSite();
        validateTel();
        validateCheckbox();
    }



    $("#register-form-button").click(function() {
        validateForm();
    });
});