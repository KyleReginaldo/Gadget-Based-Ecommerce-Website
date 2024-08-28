var my_handlers = {
    
    fill_provinces: function() {
        
        var region_code = $(this).val();

        
        var region_text = $(this).find("option:selected").text();
        let region_input = $('#region-text');
        region_input.val(region_text);
        
        $('#province-text').val('');
        $('#city-text').val('');
        $('#barangay-text').val('');

        
        let dropdown = $('#province');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
        dropdown.prop('selectedIndex', 0);

        
        let city = $('#city');
        city.empty();
        city.append('<option selected="true" disabled></option>');
        city.prop('selectedIndex', 0);

        
        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');
        barangay.prop('selectedIndex', 0);

        
        var url = 'ph-json/province.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.region_code == region_code;
            });

            result.sort(function(a, b) {
                return a.province_name.localeCompare(b.province_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
            })

        });
    },
    
    fill_cities: function() {
        
        var province_code = $(this).val();

        
        var province_text = $(this).find("option:selected").text();
        let province_input = $('#province-text');
        province_input.val(province_text);
        
        $('#city-text').val('');
        $('#barangay-text').val('');

        
        let dropdown = $('#city');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');
        dropdown.prop('selectedIndex', 0);

        
        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');
        barangay.prop('selectedIndex', 0);

        
        var url = 'ph-json/city.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.province_code == province_code;
            });

            result.sort(function(a, b) {
                return a.city_name.localeCompare(b.city_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
            })

        });
    },
    
    fill_barangays: function() {
        
        var city_code = $(this).val();

        
        var city_text = $(this).find("option:selected").text();
        let city_input = $('#city-text');
        city_input.val(city_text);
        
        $('#barangay-text').val('');

        
        let dropdown = $('#barangay');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose barangay</option>');
        dropdown.prop('selectedIndex', 0);

        
        var url = 'ph-json/barangay.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.city_code == city_code;
            });

            result.sort(function(a, b) {
                return a.brgy_name.localeCompare(b.brgy_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
            })

        });
    },

    onchange_barangay: function() {
        
        var barangay_text = $(this).find("option:selected").text();
        let barangay_input = $('#barangay-text');
        barangay_input.val(barangay_text);
    },

};

$(function() {
    
    $('#region').on('change', my_handlers.fill_provinces);
    $('#province').on('change', my_handlers.fill_cities);
    $('#city').on('change', my_handlers.fill_barangays);
    $('#barangay').on('change', my_handlers.onchange_barangay);

    
    let dropdown = $('#region');
    dropdown.empty();
    dropdown.append('<option selected="true" disabled>Choose Region</option>');
    dropdown.prop('selectedIndex', 0);
    const url = 'ph-json/region.json';
    
    $.getJSON(url, function(data) {
        $.each(data, function(key, entry) {
            dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
        })
    });

});