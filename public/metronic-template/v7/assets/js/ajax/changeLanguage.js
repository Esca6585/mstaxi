$("#changeLanguage").on('change',function(e){
    var language = $(this).val();
    var link = window.location.pathname;

    goLink(language, link);
});

function goLink(language, link)
{
    window.location.pathname = '/' + language + link.substring(3);
}