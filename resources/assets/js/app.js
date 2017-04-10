
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

console.log('01001000011010010111001001100101001000000110110101100101001000000011101100101001');

$(function() {
    let dataHide = $('[data-hide]');
    let companySelect = $('#company_id');
    let departmentSelect = $('#department_id');

    dataHide.fadeOut(5000);

    companySelect.on('change', function(e) {
        let companyId = e.target.value;
        let render = {};
        $.ajax({
            method: "POST",
            url: "/api/" + companyId + "/departments",
        }).done(function(result) {
            $(result).each(function (k, v) {
                render[v.id] = v.name
            });
            departmentSelect.empty();
            for(let key in render) {
                departmentSelect.append('<option value="' + key +'" >' + render[key] + '</option>');
            }
        }).fail(function() {
            departmentSelect.empty();
            departmentSelect.append('<option value="" selected="selected">Сначала выберите компанию</option>');
        });
    });
});
