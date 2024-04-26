function downloadExcel(tableId, fileName) {
    var table = document.getElementById(tableId);
    var wb = XLSX.utils.book_new();
    var ws = XLSX.utils.table_to_sheet(table);

    for (var i = 0; i < table.rows.length; i++) {
        var row = table.rows[i];
        for (var j = 0; j < row.cells.length; j++) {
            var cellElement = row.cells[j];
            var cellAddress = XLSX.utils.encode_cell({ r: i, c: j });
            var cell = ws[cellAddress];
            if (cellElement.classList.contains('exclude-from-excel')) {
                delete ws[cellAddress];
            }
        }
    }

    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });
    saveAsExcelFile(wbout, fileName);
}


function saveAsExcelFile(buffer, fileName) {
    var blob = new Blob([s2ab(buffer)], { type: "application/octet-stream" });
    var url = window.URL.createObjectURL(blob);
    var link = document.createElement("a");
    link.href = url;
    link.setAttribute("download", fileName);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
    return buf;
}

