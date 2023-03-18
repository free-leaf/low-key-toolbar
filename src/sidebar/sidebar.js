import { registerPlugin } from "@wordpress/plugins";
import api from "@wordpress/api";
import { PluginSidebar, PluginSidebarMoreMenuItem } from "@wordpress/edit-post";
import { PanelBody, ToggleControl, RangeControl } from "@wordpress/components";
import { useState, useEffect, Fragment } from "@wordpress/element";
import { __ } from "@wordpress/i18n";

// アイコンデータ
const LowKeyToolbarIcon = () => (
	<svg width="24px" viewBox="0 0 104 50">
		<g>
			<path d="M80.815,42.956c-0,-1.242 -1.008,-2.25 -2.25,-2.25l-53.5,-0c-1.242,-0 -2.25,1.008 -2.25,2.25l-0,4.5c-0,1.242 1.008,2.25 2.25,2.25l53.5,-0c1.242,-0 2.25,-1.008 2.25,-2.25l-0,-4.5Z" />
			<path d="M54.815,1.497c-0,-0.827 -0.672,-1.5 -1.5,-1.5l-3,0c-0.828,0 -1.5,0.673 -1.5,1.5l-0,13c-0,0.828 0.672,1.5 1.5,1.5l3,0c0.828,0 1.5,-0.672 1.5,-1.5l-0,-13Z" />
			<path d="M24.518,8.694c-0.451,-0.695 -1.38,-0.892 -2.075,-0.441l-2.516,1.634c-0.694,0.451 -0.892,1.38 -0.441,2.075l7.08,10.902c0.451,0.695 1.381,0.892 2.075,0.441l2.516,-1.634c0.695,-0.45 0.892,-1.38 0.441,-2.075l-7.08,-10.902Z" />
			<path d="M3.474,30.381c-0.75,-0.35 -1.643,-0.025 -1.993,0.726l-1.268,2.718c-0.35,0.751 -0.025,1.644 0.726,1.994l11.782,5.494c0.75,0.35 1.643,0.025 1.993,-0.726l1.268,-2.719c0.35,-0.75 0.025,-1.643 -0.726,-1.993l-11.782,-5.494Z" />
			<path d="M84.906,12.532c0.463,-0.686 0.282,-1.619 -0.404,-2.082l-2.487,-1.677c-0.687,-0.463 -1.62,-0.282 -2.083,0.404l-7.269,10.778c-0.463,0.686 -0.282,1.619 0.404,2.082l2.488,1.678c0.686,0.463 1.619,0.281 2.082,-0.405l7.269,-10.778Z" />
			<path d="M102.686,35.819c0.751,-0.35 1.076,-1.243 0.726,-1.994l-1.268,-2.718c-0.35,-0.751 -1.243,-1.076 -1.994,-0.726l-11.782,5.494c-0.75,0.35 -1.075,1.243 -0.725,1.993l1.268,2.719c0.35,0.751 1.243,1.076 1.993,0.726l11.782,-5.494Z" />
		</g>
	</svg>
);

let PluginMetaFields = () => {
	// set initial position
	let opDef = parseFloat(lktb_opt["opacity"]);
	let scaleDef = parseFloat(lktb_opt["scale"]);
	let marginDef = parseFloat(lktb_opt["margin"]);
	let opFlgDef = "" === lktb_opt["on_flg"] ? false : lktb_opt["on_flg"];

	const [opacity, setOpacity] = useState(opDef);
	const [scale, setScale] = useState(scaleDef);
	const [margin, setMargin] = useState(marginDef);
	const [showFlg, setShowFlg] = useState(opFlgDef);

	useEffect(() => {
		// change css value
		document.body.style.setProperty("--toolbar_opacity", String(opacity));
		document.body.style.setProperty("--toolbar_scale", String(scale));
		document.body.style.setProperty("--toolbar_margin", String(margin));

		// toggle body class
		if (!showFlg) {
			document.body.classList.remove("is_hover_effect");
		} else {
			document.body.classList.add("is_hover_effect");
		}

		// save data
		api.loadPromise.then(() => {
			const model = new api.models.Settings({
				low_key_toolbar_on_flg: showFlg,
				low_key_toolbar_opacity: opacity,
				low_key_toolbar_scale: scale,
				low_key_toolbar_margin: margin,
			});
			const save = model.save();

			/* 	save.success((response, status) => {
							console.log(response);
							console.log(status);
						});

				save.error((response, status) => {
					console.log(response);
					console.log(status);
				}); */
		});
	});

	return (
		<Fragment>
			<PanelBody>
				<RangeControl
					label={__("Opacity", "low-key-toolbar")}
					value={opacity}
					// allowReset={true}
					initialPosition={opDef}
					min={0.1}
					max={1}
					step={0.1}
					onChange={(value) => setOpacity(value)}
				/>
				<RangeControl
					label={__("Scale", "low-key-toolbar")}
					value={scale}
					// allowReset={true}
					initialPosition={scaleDef}
					min={0.1}
					max={1}
					step={0.1}
					onChange={(value) => setScale(value)}
				/>
				<RangeControl
					label={__("Margin Bottom (px)", "low-key-toolbar")}
					value={margin}
					// allowReset={true}
					initialPosition={marginDef}
					min={0}
					max={12}
					step={1}
					onChange={(value) => setMargin(value)}
				/>
			</PanelBody>
			<PanelBody>
				<ToggleControl
					label={__(
						"When hovering, Return to original size",
						"low-key-toolbar"
					)}
					checked={showFlg}
					onChange={() => setShowFlg(!showFlg)}
				/>
			</PanelBody>
		</Fragment>
	);
};

const LowKeyToolBarPluginSidebar = () => {
	return (
		<Fragment>
			<PluginSidebarMoreMenuItem target="sidebar-name">
				{__("Low-Key ToolBar setting", "low-key-toolbar")}
			</PluginSidebarMoreMenuItem>
			<PluginSidebar
				name="sidebar-name"
				icon={LowKeyToolbarIcon}
				title={__("Low-Key ToolBar", "low-key-toolbar")}
			>
				<PluginMetaFields />
			</PluginSidebar>
		</Fragment>
	);
};

registerPlugin("low-key-toolbar", {
	icon: <LowKeyToolbarIcon />,
	render: LowKeyToolBarPluginSidebar,
});
