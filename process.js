function function2() {
    getTableRowDatafl07();
    // fl_07pdfsend();
}


// ADD Product function ajaxa

function add_product() {

    var product_name = document.getElementById("pname").value;
    var product_Price = document.getElementById("pprice").value;
    var product_vol = document.getElementById("pvolume").value;
    var product_type = document.getElementById("ptype").value;

    if (product_name.trim() === '' || isNaN(parseFloat(product_Price))) {
        alert("Please enter valid product name and price.");
        return;
    }

    var f = new FormData();
    f.append("product_name", product_name);
    f.append("product_Price", product_Price);
    f.append("product_vol", product_vol);
    f.append("product_type", product_type);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
        }
    }

    r.open("POST", "process/add_product_f.php", true);
    r.send(f);
}



// edit product ajax function

function edit_product_detail(productId) {


    var unitPrice = document.getElementById('unit_price_' + productId).value;

    var f = new FormData();
    f.append("product_Price", unitPrice);
    f.append("pid", productId)

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
        }
    }

    r.open("POST", "process/update_product_detail_f.php", true);
    r.send(f);

}


// product search function 

function search() {
    document.getElementById('searchInput').addEventListener('input', function () {
        var query = this.value.trim().toLowerCase();
        var table = document.getElementById('dataTable');
        var rows = table.getElementsByTagName('tr');
        for (var i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
            var row = rows[i];
            var cells = row.getElementsByTagName('td');
            var found = false;
            for (var j = 0; j < cells.length; j++) {
                var cellText = cells[j].textContent.toLowerCase();
                if (cellText.indexOf(query) > -1) {
                    found = true;
                    break;
                }
            }
            if (found) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });

}



// set ,ax date fnction

document.addEventListener('DOMContentLoaded', function () {
    var currentDate = new Date();
    currentDate.setDate(currentDate.getDate() + 1);
    var maxDate = currentDate.toISOString().split('T')[0];
    document.getElementById('date').max = maxDate;
});


// fl 07  receved and send function

document.addEventListener('DOMContentLoaded', function () {
    var rows = document.querySelectorAll('#dataTablefl07 tbody tr');

    rows.forEach(function (row) {
        var receivedInput = row.querySelector('.received-input');
        var sendqty = row.querySelector('.to-fl08-input');

        var openstk = row.querySelector('.open-stk');
        var openstkint = parseInt(openstk.textContent);

        var balanceCell = row.querySelector('.balance-cell');

        receivedInput.addEventListener('input', inputHandler);
        sendqty.addEventListener('input', inputHandler);

        function inputHandler() {
            var receivedValue = parseInt(receivedInput.value) || 0;
            var sendamou = parseInt(sendqty.value) || 0;
            var new_bal = (receivedValue - sendamou) + openstkint
            balanceCell.textContent = new_bal;
        }

    });
});



// fl07 table data update query


function getTableRowDatafl07() {
    var rows = document.querySelectorAll('#dataTablefl07 tbody tr');

    var flag1 = false;

    rows.forEach(function (row) {
        var dt = document.getElementById('datemark').textContent;
        var pid = row.querySelector('.product_id').textContent;
        var rece = row.querySelector('.received-input');
        var sen = row.querySelector('.to-fl08-input');
        var blnc = row.querySelector('.balance-cell').textContent;
        var intblnc = parseInt(blnc) || 0;
        var receivedValue = parseInt(rece.value) || 0;
        var sendamou = parseInt(sen.value) || 0;

        if (receivedValue !== 0 || sendamou !== 0) {

            var f = new FormData();
            f.append("pid", pid);
            f.append("received", receivedValue);
            f.append("sent", sendamou);
            f.append("blnc", intblnc);
            f.append("date", dt);

            var r = new XMLHttpRequest();

            r.onreadystatechange = function () {
                if (r.readyState == 4 && r.status == 200) {
                    if (r.responseText != "SUCCESS") {
                        flag1 = true;
                    }
                    // alert (r.responseText)
                }
            }

            r.open("POST", "process/fl_07_f.php", true);
            r.send(f);
        }
    });

    if (flag1 == false) {
        alert("Data Updated successfully");
    }
}



// add new stock process


function add_new_stock() {
    var date = document.getElementById("date").value;
    var qty = document.getElementById("qty").value;
    var product_n = document.getElementById("dropd").value;


    if (date.trim() === '' || qty.trim() === '' || product_n.trim() === '') {
        alert("Please enter valid values for date, quantity, and product ID.");
        return;
    }

    var f = new FormData();
    f.append("product_name", product_n);
    f.append("qty", qty);
    f.append("date", date)

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
        }
    }

    r.open("POST", "process/add_new_stock_f.php", true);
    r.send(f);


}



// fl- 08 table sold amount calculation process 

document.addEventListener('DOMContentLoaded', function () {
    var rows = document.querySelectorAll('#dataTablefl08 tbody tr');

    rows.forEach(function (row) {
        var balance_amount = row.querySelector('.balance-amount');
        var open_stock = row.querySelector('.open-stk');
        var receievd = row.querySelector('.received');
        var open_stk = parseInt(open_stock.textContent) || 0;
        var receive = parseInt(receievd.textContent) || 0;

        var unit_price = row.querySelector('.unit_price');
        var unit_p = parseInt(unit_price.textContent) || 0;


        var sold_cell = row.querySelector('.sold-cell');
        var sale_amount = row.querySelector('.sale-amount');
        var sold_a = parseInt(sold_cell.value) || 0;

        balance_amount.addEventListener('input', function () {


            var balance_a = parseInt(balance_amount.value) || 0;

            var new_blnc = open_stk + receive - balance_a;

            sold_cell.textContent = new_blnc;
            console.log(new_blnc)
            sale_amount.textContent = new_blnc * unit_p;


            calculateTotal();
        });

    });
});



// fl08 table update query

function getTableRowDatafl08() {
    var rows = document.querySelectorAll('#dataTablefl08 tbody tr');

    var flag = false;

    rows.forEach(function (row) {
        var dt = document.getElementById('datemark').textContent;
        var pid = row.querySelector('.product_id').textContent;
        var balance_amount = row.querySelector('.balance-amount').value || 0;
        var sale_amount = row.querySelector('.sale-amount').textContent;
        var sold = row.querySelector('.sold-cell').textContent;
        var instsold = parseInt(balance_amount) || 0;
        var sale_amo = parseInt(sale_amount) || 0;


        if (balance_amount !== 0) {

            var f = new FormData();
            f.append("pid", pid);
            f.append("sale", sale_amo);
            f.append("sold", sold);
            f.append("blnc", instsold);
            f.append("date", dt);

            var r = new XMLHttpRequest();

            r.onreadystatechange = function () {
                if (r.readyState == 4 && r.status == 200) {
                    if (r.responseText != "SUCCESS") {
                        flag = true;
                    }
                }
            }

            r.open("POST", "process/fl_08_f.php", true);
            r.send(f);
        }
    });

    if (flag == false) {
        alert("Data Updated Successfully");
    }

}


// force update 




function force_update() {

    var date = document.getElementById('datemark').textContent;

    var f = new FormData();
    f.append("date", date);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
            window.location.reload();
        }
    }

    r.open("POST", "process/force_update_f.php", true);
    r.send(f);
}



function login() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    // alert (password+username);

    var formData = new FormData();
    formData.append("user", username);
    formData.append("pwd", password);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            // alert (response);
            if (response === "SUCCESS") {
                alert("Login successful");
                window.location.href = 'dashboard.php';
            } else {
                alert(response);
            }
        }
    }
    request.open("POST", "process/login_f.php", true);
    request.send(formData);
}



// Function to convert image to Base64
function getBase64FromImageUrl(imageUrl) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.onload = function () {
            const canvas = document.createElement('canvas');
            canvas.width = img.width;
            canvas.height = img.height;

            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0);

            const dataURL = canvas.toDataURL('image/png');
            resolve(dataURL);
        };
        img.onerror = function (error) {
            reject(error);
        };
        img.src = imageUrl;
    });
}


async function fl_07pdfsend() {

    const loadingIndicator = document.getElementById('preloader1');
    loadingIndicator.style.display = 'block';


    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Generate PDF content
    const logoBase = await getBase64FromImageUrl('assets/images/ul.png');
    const logoWidth = 80;
    const logoHeight = 20;
    const pdfWidth = doc.internal.pageSize.getWidth();
    const xPosition = (pdfWidth - logoWidth) / 2;

    doc.addImage(logoBase, 'PNG', xPosition, 10, logoWidth, logoHeight);

    const startY = 10 + logoHeight + 10;

    doc.autoTable({
        html: '#dataTablefl07',
        startY: startY
    });

    const fl07 = 'fl_07';
    const dateContent = document.getElementById('datemark').textContent;

    const pdfContent = doc.output('blob');

    const formData = new FormData();
    formData.append('pdf', pdfContent, 'generated.pdf');
    formData.append('dateContent', dateContent);
    formData.append('fl07', fl07);

    // Send form data via XMLHttpRequest
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {

        if (xhr.readyState == 4 && xhr.status == 200) {
            loadingIndicator.style.display = 'none';
            if (xhr.responseText == "Message has been sent") {
                alert("Pdf sent successfully")
            } else {
                alert(xhr.responseText);
            }
        }
    };


    xhr.open('POST', 'vendor/mail.php', true);
    xhr.send(formData);
}


async function fl_08pdfsend() {

    var incomes = document.getElementById('totaloft').textContent;

    const loadingIndicator = document.getElementById('preloader1');
    loadingIndicator.style.display = 'block';


    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Generate PDF content
    const logoBase = await getBase64FromImageUrl('assets/images/ul.png');
    const logoWidth = 80;
    const logoHeight = 20;
    const pdfWidth = doc.internal.pageSize.getWidth();
    const xPosition = (pdfWidth - logoWidth) / 2;

    doc.addImage(logoBase, 'PNG', xPosition, 10, logoWidth, logoHeight);

    const startY = 10 + logoHeight + 10;

    doc.autoTable({
        html: '#dataTablefl08',
        startY: startY
    });

    const fl08 = 'fl_08';
    var dateContent = document.getElementById('datemark').textContent;

    const pdfContent = doc.output('blob');

    const formData = new FormData();
    formData.append('pdf', pdfContent, 'generated.pdf');
    formData.append('dateContent', dateContent);
    formData.append('fl08', fl08);


    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {

        if (xhr.readyState == 4 && xhr.status == 200) {
            loadingIndicator.style.display = 'none';
            if (xhr.responseText == "Message has been sent") {
                alert("Pdf sent successfully")
                window.location.reload();
                income(incomes, dateContent);
            } else {
                alert(xhr.responseText);
            }
        }
    };


    xhr.open('POST', 'vendor/mail.php', true);
    xhr.send(formData);



}




function income(incomes, date) {
    var income_of_the_day = incomes;
    var dt = date;

    var formData = new FormData();
    formData.append("income", income_of_the_day);
    formData.append("dt", dt);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            if (response !== "true") {
                alert(response);
            }
        }
    }
    request.open("POST", "process/income.php", true);
    request.send(formData);
}




function calculateTotal() {
    var table = document.getElementById("dataTablefl08");
    var rows = table.getElementsByTagName("tr");
    var totalt = document.getElementById("totaloft");

    total = 0;


    for (var i = 1; i < rows.length - 1; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var priceText = cells[8].innerText;
        var sale_am = parseInt(priceText) || 0;
        total += sale_am
        totalt.textContent = total
    }


}
calculateTotal();

