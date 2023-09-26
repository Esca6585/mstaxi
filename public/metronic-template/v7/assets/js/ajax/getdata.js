$(document).on('click', '.admin-page-link', function (event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var pagination = $("#datatable_length").val();
    var search = $("#datatable_search").val();
    
    if(search != '')
    {
        getSearchData(search, pagination, page);
    }
    else{
        getMoreData(page, pagination);
    }
});

function getMoreData(page, pagination) {
    var data = 'page=' + page + '&pagination=' + pagination;
    
    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        success: function (data) {
            $('#datatable').html(data);
        }
    });
}

$("#datatable_length").on('change',function(){
    var pagination = $("#datatable_length").val();
    
    getPaginationData(pagination);
});

function getPaginationData(pagination) {
    var data = 'pagination=' + pagination
    
    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        success: function (data) {
            $('#datatable').html(data);
        }
    });
}

$("#datatable_search").on('keyup',function(){
    var search = $("#datatable_search").val();
    var pagination = $("#datatable_length").val();

    getSearchData(search, pagination);
});

function getSearchData(search, pagination){
    var data = 'search=' + search + '&pagination=' + pagination;
    
    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        success: function (data) {
            $('#datatable').html(data);
        }
    });
}

$(document).on('click', '#search_clear', function () {
    searchClear();
    location.reload();
});

$(document).on('click', '#search_button', function () {
    searchClear();
    location.reload();
});

searchClear();

alertFade();

showClear();


function alertFade(){
    $("#alert-message").delay(2000).fadeOut(1000); // change 5000 to number of seconds in milliseconds
}

function searchClear(){
    $("#datatable_search").val('');
}

function showClear(){
    $("#datatable_length").val(10);
}