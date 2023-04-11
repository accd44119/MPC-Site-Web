const fileInput = document.querySelector("input"),
downloadBtn = document.querySelector("button");

downloadBtn.addEventListener("click", e => {
    e.preventDefault();
    downloadBtn.innerText = "Telechargement fichiers...";
    fetchDirectory(fileInput.value);
    //fetchFile(fileInput.value);
});

function fetchDirectory(url) {
    fetch(url).then(res => {
            console.log(res);
            downloadBtn.innerText = "Récuperation liste photos Album...";
       })
    .catch(() => {
        alert("Erreur sur recuperation liste photos Album!");
        downloadBtn.innerText = "Téléchargement Album";
    });
}

function fetchFile(url) {
    fetch(url).then(res => res.blob()).then(file => {
        let tempUrl = URL.createObjectURL(file);
        const aTag = document.createElement("a");
        aTag.href = tempUrl;
        aTag.download = url.replace(/^.*[\\\/]/, '');
        document.body.appendChild(aTag);
        aTag.click();
        downloadBtn.innerText = "Téléchargement Photo....";
        URL.revokeObjectURL(tempUrl);
        aTag.remove();
    }).catch(() => {
        alert("Failed to download file!");
        downloadBtn.innerText = "Télécharger Album";
    });
}