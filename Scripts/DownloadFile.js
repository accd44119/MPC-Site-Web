console.log("Récupération pointeur sur input et button");
const fileInput = document.querySelector("input"),
downloadBtn = document.querySelector("button");

downloadBtn.addEventListener("click", e => {
    e.preventDefault();
    console.log("Event click button listener");
    downloadBtn.innerText = "Préparation liste photos...";
    fetchDirectory(fileInput.value);
    //fetchFile(fileInput.value,"fichier texte");
});

function fetchDirectory(url) {
    console.log("fetchDirectory url=",url);
    fetch(url).then(res => res.text()).then( ListePhotosTexte => {
		console.log("fetchDirectory fetch ok. Reponse ListePhotosTexte = ", ListePhotosTexte);
		downloadBtn.innerText = "Création de la liste des photos de l'Album...";
		const ListePhotoArray = ListePhotosTexte.split("\r\n");
		let NomFichierTxt = ListePhotoArray.shift(); // Supression du nom du fichier txt de la tete de la liste
		let Vide = ListePhotoArray.pop(); // supression du dernier element de la liste (vide);
		let UrlRepPhotos = url.replace(NomFichierTxt,'');
		console.log("fetchDirectory UrlRepPhotos = ", UrlRepPhotos);
		for (let Photo of ListePhotoArray){
			let UrlPhoto = UrlRepPhotos + Photo;
			console.log("fetchDirectory UrlPhoto = ", UrlPhoto);
			fetchFile(UrlPhoto,Photo);
		}
		downloadBtn.innerText = "Téléchargement effectué.";

   })
    .catch(() => {
        alert("Erreur fetch fichier txt liste des photos Album!");
        downloadBtn.innerText = "Erreur lors de la création de la liste de Téléchargement de l'Album. RECOMMENCER";
    });
}

function fetchFile(urlFile,PhotoFile) {
    console.log("fetchFile urlFile=",urlFile);
    console.log("fetchFile PhotoFile=",PhotoFile);
     fetch(urlFile).then(res => res.blob()).then(file => {
        let tempUrl = URL.createObjectURL(file);
        const aTag = document.createElement("a");
        aTag.href = tempUrl;
		DownloadFile = urlFile.replace(/^.*[\\\/]/, '');
		console.log("fetchFile DownloadFile=",DownloadFile);
        aTag.download = DownloadFile;
        document.body.appendChild(aTag);
        aTag.click();
		downloadBtn.innerText = "Téléchargement Photo " + PhotoFile + " OK";
        URL.revokeObjectURL(tempUrl);
        aTag.remove();
    }).catch(() => {
        alert("Erreur lors du téléchargement des photos!");
        downloadBtn.innerText = "Erreur pendant le téléchargement de l'Album. RECOMMENCER!";
    });
}