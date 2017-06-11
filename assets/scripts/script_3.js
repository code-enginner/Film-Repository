var genre = get.byClass('genre');
for (var i = 0; i < genre.length; i++)
{
    (function (i)
    {
        return genre[i].onchange = function ()
        {
            if (this.checked === true)
            {
                //return console.log(this.getAttribute('id'));
                var data = this.getAttribute('id');
                var output_result = get.byId('output');
                data = {data:data, flag:true};
                var newRequest = new Request({
                    _method: 'POST',
                    _fileSystem: baseURL + "/app/Controllers/ajax_search_handler.php",
                    _async: true,
                    _data: data,
                    _headerMode_part1: 'Content-type',
                    _headerMode_part2: 'application/x-www-form-urlencoded'
                 }, output_result);
                return newRequest.call();
            }
        };
    })(i);
}
