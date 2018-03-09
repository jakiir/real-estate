var formControls = {}
formControls.section={
  title:"Section",
  label:"Section Title",
  type:"section",
  description:"Section Description here",
  icon:"fa-puzzle-piece",
  single:true,
}
formControls.subsection={
  title:"Sub Section",
  label:"Sub Section Title",
  type:"subsection",
  description:"Sub Section Description here",
  icon:"fa-puzzle-piece",
  data:"",
  single:true,
}
formControls.text={
  title:"Text",
  type:'text',
  placeholder:"Enter Value",
  icon:"fa-font",
  htmlName:"txt",
  data:""
}

formControls.text={
  title:"Report",
  type:'report',
  label:"Instruction Text",
  icon:"fa-font",
  htmlName:"txt"
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
