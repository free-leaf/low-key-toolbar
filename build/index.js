(()=>{"use strict";var e={n:o=>{var t=o&&o.__esModule?()=>o.default:()=>o;return e.d(t,{a:t}),t},d:(o,t)=>{for(var l in t)e.o(t,l)&&!e.o(o,l)&&Object.defineProperty(o,l,{enumerable:!0,get:t[l]})},o:(e,o)=>Object.prototype.hasOwnProperty.call(e,o)};const o=window.wp.plugins,t=window.wp.api;var l=e.n(t);const a=window.wp.editor,n=window.wp.components,r=window.wp.element,i=window.wp.i18n,s=window.ReactJSXRuntime,c=()=>(0,s.jsx)("svg",{width:"24px",viewBox:"0 0 104 50",children:(0,s.jsxs)("g",{children:[(0,s.jsx)("path",{d:"M80.815,42.956c-0,-1.242 -1.008,-2.25 -2.25,-2.25l-53.5,-0c-1.242,-0 -2.25,1.008 -2.25,2.25l-0,4.5c-0,1.242 1.008,2.25 2.25,2.25l53.5,-0c1.242,-0 2.25,-1.008 2.25,-2.25l-0,-4.5Z"}),(0,s.jsx)("path",{d:"M54.815,1.497c-0,-0.827 -0.672,-1.5 -1.5,-1.5l-3,0c-0.828,0 -1.5,0.673 -1.5,1.5l-0,13c-0,0.828 0.672,1.5 1.5,1.5l3,0c0.828,0 1.5,-0.672 1.5,-1.5l-0,-13Z"}),(0,s.jsx)("path",{d:"M24.518,8.694c-0.451,-0.695 -1.38,-0.892 -2.075,-0.441l-2.516,1.634c-0.694,0.451 -0.892,1.38 -0.441,2.075l7.08,10.902c0.451,0.695 1.381,0.892 2.075,0.441l2.516,-1.634c0.695,-0.45 0.892,-1.38 0.441,-2.075l-7.08,-10.902Z"}),(0,s.jsx)("path",{d:"M3.474,30.381c-0.75,-0.35 -1.643,-0.025 -1.993,0.726l-1.268,2.718c-0.35,0.751 -0.025,1.644 0.726,1.994l11.782,5.494c0.75,0.35 1.643,0.025 1.993,-0.726l1.268,-2.719c0.35,-0.75 0.025,-1.643 -0.726,-1.993l-11.782,-5.494Z"}),(0,s.jsx)("path",{d:"M84.906,12.532c0.463,-0.686 0.282,-1.619 -0.404,-2.082l-2.487,-1.677c-0.687,-0.463 -1.62,-0.282 -2.083,0.404l-7.269,10.778c-0.463,0.686 -0.282,1.619 0.404,2.082l2.488,1.678c0.686,0.463 1.619,0.281 2.082,-0.405l7.269,-10.778Z"}),(0,s.jsx)("path",{d:"M102.686,35.819c0.751,-0.35 1.076,-1.243 0.726,-1.994l-1.268,-2.718c-0.35,-0.751 -1.243,-1.076 -1.994,-0.726l-11.782,5.494c-0.75,0.35 -1.075,1.243 -0.725,1.993l1.268,2.719c0.35,0.751 1.243,1.076 1.993,0.726l11.782,-5.494Z"})]})});let d=()=>{let e=parseFloat(lktb_opt.opacity),o=parseFloat(lktb_opt.scale),t=parseFloat(lktb_opt.margin),a=""!==lktb_opt.on_flg&&lktb_opt.on_flg;const[c,d]=(0,r.useState)(e),[_,p]=(0,r.useState)(o),[w,b]=(0,r.useState)(t),[g,y]=(0,r.useState)(a);return(0,r.useEffect)((()=>{document.body.style.setProperty("--toolbar_opacity",String(c)),document.body.style.setProperty("--toolbar_scale",String(_)),document.body.style.setProperty("--toolbar_margin",String(w)),g?document.body.classList.add("is_hover_effect"):document.body.classList.remove("is_hover_effect"),l().loadPromise.then((()=>{new(l().models.Settings)({low_key_toolbar_on_flg:g,low_key_toolbar_opacity:c,low_key_toolbar_scale:_,low_key_toolbar_margin:w}).save()}))})),(0,s.jsxs)(r.Fragment,{children:[(0,s.jsxs)(n.PanelBody,{children:[(0,s.jsx)(n.RangeControl,{label:(0,i.__)("Opacity","low-key-toolbar"),value:c,initialPosition:e,min:.1,max:1,step:.1,onChange:e=>d(e)}),(0,s.jsx)(n.RangeControl,{label:(0,i.__)("Scale","low-key-toolbar"),value:_,initialPosition:o,min:.1,max:1,step:.1,onChange:e=>p(e)}),(0,s.jsx)(n.RangeControl,{label:(0,i.__)("Margin Bottom (px)","low-key-toolbar"),value:w,initialPosition:t,min:0,max:12,step:1,onChange:e=>b(e)})]}),(0,s.jsx)(n.PanelBody,{children:(0,s.jsx)(n.ToggleControl,{label:(0,i.__)("When hovering, Return to original size","low-key-toolbar"),checked:g,onChange:()=>y(!g)})})]})};(0,o.registerPlugin)("low-key-toolbar",{icon:(0,s.jsx)(c,{}),render:()=>(0,s.jsxs)(r.Fragment,{children:[(0,s.jsx)(a.PluginSidebarMoreMenuItem,{target:"sidebar-name",children:(0,i.__)("Low-Key ToolBar setting","low-key-toolbar")}),(0,s.jsx)(a.PluginSidebar,{name:"sidebar-name",icon:c,title:(0,i.__)("Low-Key ToolBar","low-key-toolbar"),children:(0,s.jsx)(d,{})})]})})})();