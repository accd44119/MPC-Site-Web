console.log("Récupération pointeur sur input et button");
const fileInput = document.querySelector("input"),
downloadBtn = document.querySelector("button");

downloadBtn.addEventListener("click", e => {
    e.preventDefault();
    console.log("Event click button listener");
    downloadBtn.innerText = "Préparation liste photos...";
    fetchDirectory(fileInput.value);
    //fetchFile(fileInput.value);
});

function fetchDirectory(url) {
    console.log("fetchDirectory url=",url);
    fetch(url).then(res => res.text()).then( texte => {
        console.log("fetch ok reponse text = ", texte);
        downloadBtn.innerText = "Création liste photos Album...";
    })
    .catch(() => {
        alert("Erreur fetch liste photos Album!");
        downloadBtn.innerText = "Téléchargement Album";
    });
}

function fetchFile(url) {
    console.log("fetchFile url=",url);
    fetch(url).then(res => res.blob()).then(file => {
        let tempUrl = URL.createObjectURL(file);
        const aTag = document.createElement("a");
        aTag.href = tempUrl;
        aTag.download = url.replace(/^.*[\\\/]/, '');
        document.body.appendChild(aTag);
        aTag.click();
        downloadBtn.innerText = "Téléchargement Photos....";
        URL.revokeObjectURL(tempUrl);
        aTag.remove();
    }).catch(() => {
        alert("Failed to download file!");
        downloadBtn.innerText = "Télécharger Album";
    });
}