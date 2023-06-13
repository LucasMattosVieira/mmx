function handleSelectImages(event) {
    document.getElementById("fileLabel").textContent = `${event.target.files.length} imagens selecionadas`;
  }
  
  function handleSubmit() {
    const btnSubmit = document.querySelector(`button[type="submit"]`);
    btnSubmit.disabled = true;
    btnSubmit.textContent = "Salvando...";
  }
  
  document.getElementById("image").addEventListener("change", handleSelectImages);
  document.getElementById("updateAdForm").addEventListener("submit", handleSubmit);