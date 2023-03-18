import { registerPlugin } from "@wordpress/plugins";
import api from "@wordpress/api";
import { PluginSidebar, PluginSidebarMoreMenuItem } from "@wordpress/edit-post";

import { PanelBody, ToggleControl, RangeControl } from "@wordpress/components";

import { useState, useEffect, Fragment } from "@wordpress/element";

import { __ } from "@wordpress/i18n";
import $ from "jquery";

let PluginMetaFields = () => {
	// set initial position
	const opDef = lktb_opt["opacity"];
	const scaleDef = lktb_opt["scale"];
	const marginDef = lktb_opt["margin"];
	const opFlgDef = "" === lktb_opt["on_flg"] ? false : lktb_opt["on_flg"];

	const [opacity, setOpacity] = useState(opDef);
	const [scale, setScale] = useState(scaleDef);
	const [margin, setMargin] = useState(marginDef);
	const [showFlg, setShowFlg] = useState(opFlgDef);

	useEffect(() => {
		// change css value
		$("body").css({
			"--toolbar_opacity": String(opacity),
		});
		$("body").css({
			"--toolbar_scale": String(scale),
		});
		$("body").css({
			"--toolbar_margin": String(margin),
		});

		// toggle body class
		if (!showFlg) {
			$(".block-editor-page").removeClass("is_hover_effect");
		} else {
			$(".block-editor-page").addClass("is_hover_effect");
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
	const postType = wp.data.select("core/editor").getCurrentPostType();
	if ("post" === postType || "page" === postType) {
		return (
			<Fragment>
				<PluginSidebarMoreMenuItem target="sidebar-name">
					{__("Low-Key ToolBar setting", "low-key-toolbar")}
				</PluginSidebarMoreMenuItem>
				<PluginSidebar
					name="sidebar-name"
					icon="admin-settings"
					title={__("Low-Key ToolBar", "low-key-toolbar")}
				>
					<PluginMetaFields />
				</PluginSidebar>
			</Fragment>
		);
	} else {
		return null;
	}
};
registerPlugin("low-key-toolbar", {
	icon: "admin-settings",
	render: LowKeyToolBarPluginSidebar,
});
