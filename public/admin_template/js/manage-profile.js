function updateSerial(table) {
    var table_count = $(table).find('.count');
    count = 0;
    $(table_count).each(function () {
        count++;console.log(count);
        $(this).html(count);
    });
    return count;
}
 

$(document).on('click', '.remove', function (e) {
    var row = $(this).closest('tr');
    var table = $(this).closest('table');
    $(row).remove();
    updateSerial(table);
});

$(document).on('keyup', '.profile', function (e) {
    var value = $(this).val(); 
    var row = $(this).closest('tr');
    var  profilerList = $(row).find('.profilerList');
    var  pSpinner = $(row).find('.p-spinner');
    var  remittnce_type = $('.remitence_type').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'GET',
        url: base_url+'/getProfilers/'+remittnce_type+'/'+value ,
        beforeSend: function () {
            $(pSpinner).fadeIn();
        },
    }).done(function (response) {
        console.log(response);
        $(pSpinner).fadeOut();
        if(response.success){
            $(pSpinner).fadeOut();
            $(profilerList).fadeIn();
            $(profilerList).html(response.html);
        }else{
            $(pSpinner).fadeOut();
            swal.fire("Error", response.msg, "error");
        }
    }).fail(function (error) {
        console.log(error); 
    });
});
 

$(document).click(function() {
    var obj = $(".profilerList");
    if (!obj.is(event.target) && !obj.has(event.target).length) {
      $(obj).fadeOut();
    } else {
        $(obj).fadeOut();
    }
});

$(document).on('click', '.profile-li', function(){
    var profile_id = $(this).data('profile_id')
    var profile_name = $(this).data('profile_name') 
    var row = $(this).closest('tr'); 
    $(row).find('.profile').val(profile_name);
    $(row).find('.profile_id').val(profile_id);
    getBeneficiaries(row, profile_id);
});
function getBeneficiaries(row, profile_id){ 
   
    var  beneficiariesList = $(row).find('.beneficiariesList');
    console.log('beneficiariesList', beneficiariesList);
    var  bSpinner = $(row).find('.b-spinner');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'GET',
        url: base_url+'/getBeneficiaries/'+profile_id ,
        beforeSend: function () {
            $(bSpinner).fadeIn();
        },
    }).done(function (response) {
        console.log(response);
        $(bSpinner).fadeOut();
        if(response.success){
            $(beneficiariesList).html(response.html);
        }else{
            $(bSpinner).fadeOut();
            swal.fire("Error", response.msg, "error");
        }
    }).fail(function (error) {
        console.log(error);
    });
}

$(document).on('change', '.beneficiary', function(){
    //select beneficiary and assign vale to input field
    var row = $(this).closest('tr');  
    var beneficiary_name = $(this).find(":selected").text();
    
    $(row).find('.beneficiary_name').val(beneficiary_name); 
});

function addRow(e, counter) {
    var table = $(e.target).closest('table');
    var table_count = $(table).find('.count');
    addRowDetail(table, counter, table_count.length);
}

function addRowDetail(table, remetence_count, row_count ) {
    row_count++;
     
    const row = `<tr>
                    <td class="count">${remetence_count}</td>
                    <input type="hidden"  name="Profile[${row_count}][profile_id]" class="profile_id"   >
                    <td><input type="text"   autocomplete="off"  
                    class="form-control profile"  placeholder="Enter profiler name">
                        <div  class="dropdown text-center ">
                            <div class="profilerList">
                            </div>
                            <div class="spinner-border text-purple  mt-2 p-spinner"   style="display: none" role="status"></div>
                        </div>
                    </td>
                    <td>
                        <div class="position-relative">
                            <select name="Profile[${row_count}][beneficiary_id]" class="form-control beneficiary beneficiariesList">
                                <option value="">Select Beneficiary</option>
                            </select> 
                             <div class="spinner-border text-purple  mt-2 b-spinner"   style="display: none" role="status"></div>
                        </div>
                    </td>
                    <td>
                    <input type="date" placeholder="Date"name="Profile[${row_count}][date]" class="form-control date"> 
                    </td>
                    <td><button type="button" class="remove">-</button></td>
                </tr>`;
    $(table).append(row);
    updateSerial(table);
}


