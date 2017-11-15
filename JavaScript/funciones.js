function nombre(fic) {
  fic = fic.split('\\');
  filename = fic[fic.length-1];
  document.getElementById("letras").innerHTML = filename;
}