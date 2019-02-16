var formControls = {}
formControls.section={
  title:"Section",
  label:"Section Title",
  type:"section",
  description:"Section Description here",
  icon:"fa-puzzle-piece",
  single:true
}
formControls.subsection={
  title:"Sub Section",
  label:"Sub Section Title",
  type:"subsection",
  description:"Sub Section Description here",
  icon:"fa-puzzle-piece",
  data:"",
  single:true
}
formControls.text={
  title:"Text",
  type:'text',
  //placeholder:"Enter Value",
  icon:"fa-text-height",
  htmlName:"txt",
  default:"Default Value",
  data:""
  
  /*title:"Comment",
  label:"Comments",
  type:'comment',
  icon:"fa-edit",
  htmlName:"cmt",
  //noProperty:true,
  editMode:true,
  data:"<h5>Comment Field</h5><p>This is a comment field, It will appear as this rich text editor, you can edit it to add example</p>"*/
  
}

formControls.reportfield={
  title:"Report",
  type:'report',
  label:"Report field",
  icon:"fa-file-o",
  single:true
}

formControls.reportformfield={
  title:"Report Form",
  type:'report_form',
  label:"Report Form field",
  icon:"fa-file",
  single:true
}

formControls.label={
  title:"Label",
  type:'label',
  label:"Label Field",
  icon:"fa-text-width"
}
formControls.wysiwyg={
  title:"Paragraph",
  label:"Comments",
  type:'wysiwyg',
  icon:"fa-edit",
  htmlName:"cmt",
  noProperty:true,
  editMode:false,
  isInstruction:false,
  data:"<h3>Edit me</h4><p>this is a rich text, click the edit button to edit the content. you can add as many lines you want</p>"
}
formControls.checkbox={
  title:"CheckBox",
  label:"Checkbox",
  type:'checkbox',
  icon:"fa-check-square",
  htmlName:"chk"
}
formControls.image={
  title:"Image",
  type:'image',
  icon:"fa-image",
  url:"#",
  isExample:false,
  withComment:false,
  data:"<h5>Sample Image Comment</h5><p>This is a sample image comment, you can modify or delete it</p>"
}
formControls.comment={
  title:"Comment",
  label:"Comments",
  type:'comment',
  icon:"fa-edit",
  htmlName:"cmt",
  //noProperty:true,
  editMode:true,
  data:"<h5>Comment Field</h5><p>This is a comment field, It will appear as this rich text editor, you can edit it to add example</p>"
}
formControls.static={
  title:"Instruction",
  type:'static',
  label:"Instruction Text",
  icon:"fa-info-circle"
}
formControls.pagebreak={
  title:"Page Break",
  label:"Page Break",
  type:'break',
  single:true,
  icon:"fa-file-text-o"
}
formControls.conditional={
  title:"Conditional",
  label:"Conditional Message",
  type:'conditional',
  icon:"fa-question-circle",
  target:"conditional_text",
  message:"Reason Text",
  checked:false
}
formControls.reason={
  title:"Reason",
  htmlName:"reason",
  type:'reason',
  icon:"fa-comment",
  reason:""
}
formControls.advertisement={
  title:"Ad",
  label:"advertisement",
  type:'advertisement',
  icon:"fa-edit",
  htmlName:"cmt",
  editMode:true,
  data:"<h5>THIS BOX FOR ADVERTISEMENT. KEEP BLANK IF NO ADVERTISEMENT</h5>"
}
formControls.textarea={
  title:"Textarea",
  type:'textarea',
  icon:"fa-text-width",
  htmlName:"txt",
  editMode:true,
  data:""
}
formControls.shortcode={
  title:"Shortcode",
  type:'shortcode',
  icon:"fa-text-width",
  htmlName:"txt",
  editMode:true,
  data:""
}
