$(function() {
    $('#torrents-table a.download').click(function() {
        var td = $(this).parents('tr').find('td.downloads');
        var downloads = parseInt(td.text().trim()) + 1;
        td.text(downloads);
    });
});