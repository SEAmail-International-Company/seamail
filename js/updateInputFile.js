function updateInputFile(id, name){
    const name = document.querySelector('#' + id + ' input[type=file]');
    name.onchange = () => {
      if (name.files.length > 0) {
        const fileNameSalon = document.querySelector('#' + id + ' .file-name');
        fileNameSalon.textContent = name.files[0].name;
      }
    }
}