tinymce.init({
  selector: '#tinytextarea',
  height: 500,
  theme: 'modern',
  menubar: 'false',
  plugins: [
    'advlist autolink autosave lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
  toolbar1: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor',
  toolbar2: 'styleselect fontsizeselect | insert code codesample preview fullscreen',
  image_advtab: true,
  fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ]
 });