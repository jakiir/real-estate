var formControls = {}
formControls.text={
  title:"Text",
  label:"Text Input",
  type:'text',
  placeholder:"Enter Value",
  icon:"fa-font",
  htmlName:"txt"
}
formControls.number={
  title:"Number",
  label:"Number",
  type:"number",
  default:0,
  placeholder:"Please Enter a number",
  icon:"fa-list-ol",
  htmlName:"nbr"
}
formControls.paragraph={
  title:"Paragraph",
  label:"Paragraph",
  type:'textarea',
  placeholder:"Enter Long Text here",
  icon:"fa-font",
  htmlName:"pgh"
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
  url:"#"
}
formControls.wysiwyg={
  title:"Comment",
  label:"Comments",
  type:'wysiwyg',
  icon:"fa-edit",
  htmlName:"cmt"
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
  htmlName:"cond",
  label:"Conditional Message",
  type:'conditional',
  icon:"fa-comment",
  message:"This message will show up"
}
