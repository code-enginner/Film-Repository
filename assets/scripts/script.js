var btn = get.byId('btnSearch');
btn.addEventListener('click', filmSearch);
function filmSearch()
{
    var myValue, output_result, request;
    myValue = get.byId('searchFile').value;
    myValue = {data:myValue};
    output_result = get.byId('output');
    request = new Request
    ({
        _method: 'POST',
        _fileSystem: baseURL + "/app/Controllers/ajax_search_handler.php",
        _async: true,
        _data: myValue,
        _headerMode_part1: 'Content-type',
        _headerMode_part2: 'application/x-www-form-urlencoded'
    }, output_result);
    request.check();
    request.call();
}

