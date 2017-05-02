
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
// const app = new Vue({
//     el: '#app'
// });

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    let dataHide = $('[data-hide]');
    let companySelectForDepartment = $('[data-company-departments]');
    let companySelectForEmployee = $('[data-company-employees]');
    let departmentSelect = $('#department_id');
    let employeesSelect = $('#user_id');

    dataHide.fadeOut(3000);

    function ajaxLoadData(selector, appendTo, uri) {
        selector.on('change', function(e) {
            let companyId = e.target.value;
            let render = {};
            $.ajax({
                method: "POST",
                url: "/api/" + companyId + "/" + uri,
            }).done(function(result) {
                $(result).each(function (k, v) {
                    if(uri === 'departments') {
                        render[v.id] = v.name;
                    } else {
                        render[v.id] = v.name + ' ' + v.last_name;
                    }
                });
                appendTo.empty();
                if(!$.isEmptyObject(render)) {
                    for(let key in render) {
                        appendTo.append('<option value="' + key +'" >' + render[key] + '</option>');
                    }
                } else {
                    appendTo.append('<option value="" >Сотрудников нет</option>');
                }
            }).fail(function() {
                appendTo.empty();
                appendTo.append('<option value="" selected="selected">Сначала выберите компанию</option>');
            });
        });
    }

    ajaxLoadData(companySelectForDepartment, departmentSelect, 'departments');
    ajaxLoadData(companySelectForEmployee, employeesSelect, 'employees');


    let $costsButton = $('[data-costs-save]');
    let $trip = $('[data-trip]').data('trip');
    let $notifyField = $('[data-costs-notify]');
    let $input = $('[data-costs-field]');
    let $form = $('[data-costs-form]');

    $form.on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: '/panel/costs/store',
            data: $(this).serialize()
        }).done(function(result) {
            if(JSON.parse(result).result) {
                $notifyField.text('Успешно добавлено');
                $input.val('');
            } else {
                $notifyField.text('Ошибка ввода');
            }
        });
    })
});
