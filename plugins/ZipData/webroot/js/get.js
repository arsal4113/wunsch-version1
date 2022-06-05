

document.getElementById("postal-code").onchange = getAreaName;

function getAreaName() {
    const zip = document.getElementById("postal-code").value;
    if (zip.length >= 3) {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let obj = JSON.parse(this.responseText);
                if (obj.ZipData) {
                    document.getElementById("city").value =  obj.ZipData.city;
                    document.getElementById("state-or-province").value = obj.ZipData.area;
                }
            }
        };
        xmlhttp.open("GET", "/zip-data/zip-data-zips/getByCode/" + zip, true);
        xmlhttp.send();
    }
}

