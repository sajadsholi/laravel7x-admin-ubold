var latInput = $('input[name=lat]');
var lngInput = $('input[name=lng]');

const lat = parseFloat($('#map').data('lat'));
const lng = parseFloat($('#map').data('lng'));

const map = L.map('map', {
    scrollWheelZoom: false
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

$(function() {

    $('#addMobile').on('click', function() {
        var step = $(this).data('step');
        var str = `<div class="col-md-4">
        <div class="form-group mb-3">
            <label for="contactTitle${step}">
            ${window.i18n.common['title']}
            <span class='text-danger'>*</span>
             </label>
            <input placeholder="Contact Title" class="form-control" name="contactTitle[]" type="text" id="contactTitle${step}"
            title="${window.i18n.common['required']}"  
             required />
            <div class="invalid-feedback">
            ${window.i18n.common['invalid-feedback']}
        </div>
        </div>
    </div>
    <div class="col-md-8">
    <div class="form-group mb-3">
        <label for="contactNumber${step}">
        ${window.i18n.common['contact_number']}
        <span class='text-danger'>*</span>
        </label>
        <div class="input-group">
            <input placeholder="Contact Number" pattern="[0-9-]+" class="form-control"
                name="contactNumber[]" type="text" id="contactNumber${step}"  
                title="${window.i18n.common['required']} <br/> ${window.i18n.common['numeric']}"
                 required />
            <div class="input-group-append deleteContactInfo" data-toggle="tooltip" title="${window.i18n.common['delete']}">
                    <button type="button" class="btn btn-danger"><i class="mdi mdi-delete"></i></button>
            </div>
            <div class="invalid-feedback">
                ${window.i18n.common['invalid-feedback']}
            </div>
        </div>
        </div>
    </div>`;
        step++;
        $(this).data('step', step);
        $(this).prev().append(str);
        myTooltip();
        $('.deleteContactInfo').on('click', function() {
            deleteContactRow($(this));
        });
    });

    $('#addAddress').on('click', function() {
        var step = $(this).data('step');
        var str = `<div class="col-md-4">
        <div class="form-group mb-3">
        <label for="titleAddress${step}">
           ${window.i18n.common['title']}
           <span class='text-danger'>*</span>
        </label>
            <input placeholder="Address Title" class="form-control" name="titleAddress[]" type="text" id="titleAddress${step}"
            title="${window.i18n.common['required']}"
            required />
                <div class="invalid-feedback">
                ${window.i18n.common['invalid-feedback']}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group mb-3">
        <label for="address${step}">
        ${window.i18n.common['address']}
            <span class='text-danger'>*</span>
        </label>
        <div class="input-group">
            <input placeholder="Address"  class="form-control"
                name="address[]" type="text" id="address${step}"
                title="${window.i18n.common['required']}"
                required />
                <div class="input-group-append deleteContactInfo" data-toggle="tooltip" title="${window.i18n.common['delete']}">
                    <button type="button"  class="btn btn-danger"><i class="mdi mdi-delete"></i></button>
                </div>
                <div class="invalid-feedback">
                ${window.i18n.common['invalid-feedback']}
            </div>
        </div>
        </div>
    </div>`;
        step++;
        $(this).data('step', step);
        $(this).prev().append(str);
        myTooltip();
        $('.deleteContactInfo').on('click', function() {
            deleteContactRow($(this));
        });
    });

    $('#addEmail').on('click', function() {
        var step = $(this).data('step');
        str = `<div class="col-md-4">
        <div class="form-group mb-3">
        <label for="titleEmail${step}">
        ${window.i18n.common['title']}
             <span class='text-danger'>*</span>
        </label>
            <input placeholder="Email Title" class="form-control" name="titleEmail[]" type="text" id="titleEmail${step}"
            title="${window.i18n.common['required']}"   
            required />
            <div class="invalid-feedback">
                ${window.i18n.common['invalid-feedback']}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group mb-3">
        <label for="email${step}">
        ${window.i18n.common['email']}
            <span class='text-danger'>*</span>
        </label>
        <div class="input-group">
            <input placeholder="Email"  class="form-control"
                name="email[]" type="email" id="email${step}"
                title="${window.i18n.common['required']} <br/> ${window.i18n.common['validEmail']}"   
                required />
            <div class="input-group-append deleteContactInfo" data-toggle="tooltip" title="${window.i18n.common['delete']}">
                    <button type="button"  class="btn waves-effect waves-light btn-danger"><i class="mdi mdi-delete"></i></button>
                </div>
                <div class="invalid-feedback">
                ${window.i18n.common['invalid-feedback']}
            </div>
        </div>
        </div>
    </div>`;
        step++;
        $(this).data('step', step);
        $(this).prev().append(str);
        myTooltip();
        $('.deleteContactInfo').on('click', function() {
            deleteContactRow($(this));
        });
    });

    $('.deleteContactInfo').on('click', function() {
        deleteContactRow($(this));
    });

    function deleteContactRow(elem) {
        $("*").tooltip('hide');
        var parent = elem.parent().parent().parent();
        parent.prev().remove();
        parent.remove('');
    }

});