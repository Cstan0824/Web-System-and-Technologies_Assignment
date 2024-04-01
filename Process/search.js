function ShowResult(str) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = () => {
        document.getElementById("events").innerHTML = this.responseText;
    };
    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
             document.getElementById("events").innerHTML = this.responseText;
        }
    };
    xmlhttp.open(
        "POST",
        "search_Process.php?RealTimeSearch=" + str + "&RTSearch_verify=true",
        true
    );
    xmlhttp.send();
}

var myform = document.getElementById("myform");
myform.addEventListener("submit", function () {
    var formdata = new FormData(myform);
    fetch("../Process/search_Process.php", { method: "POST", body: formdata })
        .then((res) => {
            if (!res.ok) {
                throw new Error("File Not Found");
            }
            return res.text();
        })
        .then((data) => {
            console.log(data);
            document.getElementById("res").innerHTML = data;
        });
});
