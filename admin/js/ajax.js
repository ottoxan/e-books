function loadContent(url) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", url);
    xhttp.send();
    xhttp.onreadystatechange = (e) => {
        document.getElementById("content-main").innerHTML = xhttp.responseText;
    }
}