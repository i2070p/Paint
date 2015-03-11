function aButtonPressed(){
    $.post('/Paint/web/app_dev.php/ajax',
    {data1: 'metix'},
        function(response){

            alert(response.code);

        }, "json");
}