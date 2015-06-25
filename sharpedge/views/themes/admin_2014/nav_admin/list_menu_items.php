<script type="text/javascript">
/*!
 * Nestable jQuery Plugin - Copyright (c) 2012 David Bushell - http://dbushell.com/
 * Dual-licensed under the BSD or MIT licenses
 */
;(function($, window, document, undefined)
{
    var hasTouch = 'ontouchstart' in document;

    /**
     * Detect CSS pointer-events property
     * events are normally disabled on the dragging element to avoid conflicts
     * https://github.com/ausi/Feature-detection-technique-for-pointer-events/blob/master/modernizr-pointerevents.js
     */
    var hasPointerEvents = (function()
    {
        var el    = document.createElement('div'),
            docEl = document.documentElement;
        if (!('pointerEvents' in el.style)) {
            return false;
        }
        el.style.pointerEvents = 'auto';
        el.style.pointerEvents = 'x';
        docEl.appendChild(el);
        var supports = window.getComputedStyle && window.getComputedStyle(el, '').pointerEvents === 'auto';
        docEl.removeChild(el);
        return !!supports;
    })();

    var defaults = {
            listNodeName    : 'ol',
            itemNodeName    : 'li',
            rootClass       : 'dd',
            listClass       : 'dd-list',
            itemClass       : 'dd-item',
            dragClass       : 'dd-dragel',
            handleClass     : 'dd-handle',
            collapsedClass  : 'dd-collapsed',
            placeClass      : 'dd-placeholder',
            noDragClass     : 'dd-nodrag',
            emptyClass      : 'dd-empty',
            expandBtnHTML   : '<button data-action="expand" type="button">Expand</button>',
            collapseBtnHTML : '<button data-action="collapse" type="button">Collapse</button>',
            group           : 0,
            maxDepth        : 4,
            threshold       : 20
        };

    function Plugin(element, options)
    {
        this.w  = $(document);
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();
    }

    Plugin.prototype = {

        init: function()
        {
            var list = this;

            list.reset();

            list.el.data('nestable-group', this.options.group);

            list.placeEl = $('<div class="' + list.options.placeClass + '"/>');

            $.each(this.el.find(list.options.itemNodeName), function(k, el) {
                list.setParent($(el));
            });

            list.el.on('click', 'button', function(e) {
                if (list.dragEl) {
                    return;
                }
                var target = $(e.currentTarget),
                    action = target.data('action'),
                    item   = target.parent(list.options.itemNodeName);
                if (action === 'collapse') {
                    list.collapseItem(item);
                }
                if (action === 'expand') {
                    list.expandItem(item);
                }
            });

            var onStartEvent = function(e)
            {
                var handle = $(e.target);
                if (!handle.hasClass(list.options.handleClass)) {
                    if (handle.closest('.' + list.options.noDragClass).length) {
                        return;
                    }
                    handle = handle.closest('.' + list.options.handleClass);
                }

                if (!handle.length || list.dragEl) {
                    return;
                }

                list.isTouch = /^touch/.test(e.type);
                if (list.isTouch && e.touches.length !== 1) {
                    return;
                }

                e.preventDefault();
                list.dragStart(e.touches ? e.touches[0] : e);
            };

            var onMoveEvent = function(e)
            {
                if (list.dragEl) {
                    e.preventDefault();
                    list.dragMove(e.touches ? e.touches[0] : e);
                }
            };

            var onEndEvent = function(e)
            {
                if (list.dragEl) {
                    e.preventDefault();
                    list.dragStop(e.touches ? e.touches[0] : e);
                }
            };

            if (hasTouch) {
                list.el[0].addEventListener('touchstart', onStartEvent, false);
                window.addEventListener('touchmove', onMoveEvent, false);
                window.addEventListener('touchend', onEndEvent, false);
                window.addEventListener('touchcancel', onEndEvent, false);
            }

            list.el.on('mousedown', onStartEvent);
            list.w.on('mousemove', onMoveEvent);
            list.w.on('mouseup', onEndEvent);

        },

        serialize: function()
        {
            var data,
                depth = 0,
                list  = this;
                step  = function(level, depth)
                {
                    var array = [ ],
                        items = level.children(list.options.itemNodeName);
                    items.each(function()
                    {
                        var li   = $(this),
                            item = $.extend({}, li.data()),
                            sub  = li.children(list.options.listNodeName);
                        if (sub.length) {
                            item.children = step(sub, depth + 1);
                        }
                        array.push(item);
                    });
                    return array;
                };
            data = step(list.el.find(list.options.listNodeName).first(), depth);
            return data;
        },

        serialise: function()
        {
            return this.serialize();
        },

        reset: function()
        {
            this.mouse = {
                offsetX   : 0,
                offsetY   : 0,
                startX    : 0,
                startY    : 0,
                lastX     : 0,
                lastY     : 0,
                nowX      : 0,
                nowY      : 0,
                distX     : 0,
                distY     : 0,
                dirAx     : 0,
                dirX      : 0,
                dirY      : 0,
                lastDirX  : 0,
                lastDirY  : 0,
                distAxX   : 0,
                distAxY   : 0
            };
            this.isTouch    = false;
            this.moving     = false;
            this.dragEl     = null;
            this.dragRootEl = null;
            this.dragDepth  = 0;
            this.hasNewRoot = false;
            this.pointEl    = null;
        },

        expandItem: function(li)
        {
            li.removeClass(this.options.collapsedClass);
            li.children('[data-action="expand"]').hide();
            li.children('[data-action="collapse"]').show();
            li.children(this.options.listNodeName).show();
        },

        collapseItem: function(li)
        {
            var lists = li.children(this.options.listNodeName);
            if (lists.length) {
                li.addClass(this.options.collapsedClass);
                li.children('[data-action="collapse"]').hide();
                li.children('[data-action="expand"]').show();
                li.children(this.options.listNodeName).hide();
            }
        },

        expandAll: function()
        {
            var list = this;
            list.el.find(list.options.itemNodeName).each(function() {
                list.expandItem($(this));
            });
        },

        collapseAll: function()
        {
            var list = this;
            list.el.find(list.options.itemNodeName).each(function() {
                list.collapseItem($(this));
            });
        },

        setParent: function(li)
        {
            if (li.children(this.options.listNodeName).length) {
                li.prepend($(this.options.expandBtnHTML));
                li.prepend($(this.options.collapseBtnHTML));
            }
            li.children('[data-action="expand"]').hide();
        },

        unsetParent: function(li)
        {
            li.removeClass(this.options.collapsedClass);
            li.children('[data-action]').remove();
            li.children(this.options.listNodeName).remove();
        },

        dragStart: function(e)
        {
            var mouse    = this.mouse,
                target   = $(e.target),
                dragItem = target.closest(this.options.itemNodeName);

            this.placeEl.css('height', dragItem.height());

            mouse.offsetX = e.offsetX !== undefined ? e.offsetX : e.pageX - target.offset().left;
            mouse.offsetY = e.offsetY !== undefined ? e.offsetY : e.pageY - target.offset().top;
            mouse.startX = mouse.lastX = e.pageX;
            mouse.startY = mouse.lastY = e.pageY;

            this.dragRootEl = this.el;

            this.dragEl = $(document.createElement(this.options.listNodeName)).addClass(this.options.listClass + ' ' + this.options.dragClass);
            this.dragEl.css('width', dragItem.width());

            dragItem.after(this.placeEl);
            dragItem[0].parentNode.removeChild(dragItem[0]);
            dragItem.appendTo(this.dragEl);

            $(document.body).append(this.dragEl);
            this.dragEl.css({
                'left' : e.pageX - mouse.offsetX,
                'top'  : e.pageY - mouse.offsetY
            });
            // total depth of dragging item
            var i, depth,
                items = this.dragEl.find(this.options.itemNodeName);
            for (i = 0; i < items.length; i++) {
                depth = $(items[i]).parents(this.options.listNodeName).length;
                if (depth > this.dragDepth) {
                    this.dragDepth = depth;
                }
            }
        },

        dragStop: function(e)
        {
            var el = this.dragEl.children(this.options.itemNodeName).first();
            el[0].parentNode.removeChild(el[0]);
            this.placeEl.replaceWith(el);

            this.dragEl.remove();
            this.el.trigger('change');
            if (this.hasNewRoot) {
                this.dragRootEl.trigger('change');
            }
            this.reset();
        },

        dragMove: function(e)
        {
            var list, parent, prev, next, depth,
                opt   = this.options,
                mouse = this.mouse;

            this.dragEl.css({
                'left' : e.pageX - mouse.offsetX,
                'top'  : e.pageY - mouse.offsetY
            });

            // mouse position last events
            mouse.lastX = mouse.nowX;
            mouse.lastY = mouse.nowY;
            // mouse position this events
            mouse.nowX  = e.pageX;
            mouse.nowY  = e.pageY;
            // distance mouse moved between events
            mouse.distX = mouse.nowX - mouse.lastX;
            mouse.distY = mouse.nowY - mouse.lastY;
            // direction mouse was moving
            mouse.lastDirX = mouse.dirX;
            mouse.lastDirY = mouse.dirY;
            // direction mouse is now moving (on both axis)
            mouse.dirX = mouse.distX === 0 ? 0 : mouse.distX > 0 ? 1 : -1;
            mouse.dirY = mouse.distY === 0 ? 0 : mouse.distY > 0 ? 1 : -1;
            // axis mouse is now moving on
            var newAx   = Math.abs(mouse.distX) > Math.abs(mouse.distY) ? 1 : 0;

            // do nothing on first move
            if (!mouse.moving) {
                mouse.dirAx  = newAx;
                mouse.moving = true;
                return;
            }

            // calc distance moved on this axis (and direction)
            if (mouse.dirAx !== newAx) {
                mouse.distAxX = 0;
                mouse.distAxY = 0;
            } else {
                mouse.distAxX += Math.abs(mouse.distX);
                if (mouse.dirX !== 0 && mouse.dirX !== mouse.lastDirX) {
                    mouse.distAxX = 0;
                }
                mouse.distAxY += Math.abs(mouse.distY);
                if (mouse.dirY !== 0 && mouse.dirY !== mouse.lastDirY) {
                    mouse.distAxY = 0;
                }
            }
            mouse.dirAx = newAx;

            /**
             * move horizontal
             */
            if (mouse.dirAx && mouse.distAxX >= opt.threshold) {
                // reset move distance on x-axis for new phase
                mouse.distAxX = 0;
                prev = this.placeEl.prev(opt.itemNodeName);
                // increase horizontal level if previous sibling exists and is not collapsed
                if (mouse.distX > 0 && prev.length && !prev.hasClass(opt.collapsedClass)) {
                    // cannot increase level when item above is collapsed
                    list = prev.find(opt.listNodeName).last();
                    // check if depth limit has reached
                    depth = this.placeEl.parents(opt.listNodeName).length;
                    if (depth + this.dragDepth <= opt.maxDepth) {
                        // create new sub-level if one doesn't exist
                        if (!list.length) {
                            list = $('<' + opt.listNodeName + '/>').addClass(opt.listClass);
                            list.append(this.placeEl);
                            prev.append(list);
                            this.setParent(prev);
                        } else {
                            // else append to next level up
                            list = prev.children(opt.listNodeName).last();
                            list.append(this.placeEl);
                        }
                    }
                }
                // decrease horizontal level
                if (mouse.distX < 0) {
                    // we can't decrease a level if an item preceeds the current one
                    next = this.placeEl.next(opt.itemNodeName);
                    if (!next.length) {
                        parent = this.placeEl.parent();
                        this.placeEl.closest(opt.itemNodeName).after(this.placeEl);
                        if (!parent.children().length) {
                            this.unsetParent(parent.parent());
                        }
                    }
                }
            }

            var isEmpty = false;

            // find list item under cursor
            if (!hasPointerEvents) {
                this.dragEl[0].style.visibility = 'hidden';
            }
            this.pointEl = $(document.elementFromPoint(e.pageX - document.body.scrollLeft, e.pageY - (window.pageYOffset || document.documentElement.scrollTop)));
            if (!hasPointerEvents) {
                this.dragEl[0].style.visibility = 'visible';
            }
            if (this.pointEl.hasClass(opt.handleClass)) {
                this.pointEl = this.pointEl.parent(opt.itemNodeName);
            }
            if (this.pointEl.hasClass(opt.emptyClass)) {
                isEmpty = true;
            }
            else if (!this.pointEl.length || !this.pointEl.hasClass(opt.itemClass)) {
                return;
            }

            // find parent list of item under cursor
            var pointElRoot = this.pointEl.closest('.' + opt.rootClass),
                isNewRoot   = this.dragRootEl.data('nestable-id') !== pointElRoot.data('nestable-id');

            /**
             * move vertical
             */
            if (!mouse.dirAx || isNewRoot || isEmpty) {
                // check if groups match if dragging over new root
                if (isNewRoot && opt.group !== pointElRoot.data('nestable-group')) {
                    return;
                }
                // check depth limit
                depth = this.dragDepth - 1 + this.pointEl.parents(opt.listNodeName).length;
                if (depth > opt.maxDepth) {
                    return;
                }
                var before = e.pageY < (this.pointEl.offset().top + this.pointEl.height() / 2);
                    parent = this.placeEl.parent();
                // if empty create new list to replace empty placeholder
                if (isEmpty) {
                    list = $(document.createElement(opt.listNodeName)).addClass(opt.listClass);
                    list.append(this.placeEl);
                    this.pointEl.replaceWith(list);
                }
                else if (before) {
                    this.pointEl.before(this.placeEl);
                }
                else {
                    this.pointEl.after(this.placeEl);
                }
                if (!parent.children().length) {
                    this.unsetParent(parent.parent());
                }
                if (!this.dragRootEl.find(opt.itemNodeName).length) {
                    this.dragRootEl.append('<div class="' + opt.emptyClass + '"/>');
                }
                // parent root list has changed
                if (isNewRoot) {
                    this.dragRootEl = pointElRoot;
                    this.hasNewRoot = this.el[0] !== this.dragRootEl[0];
                }
            }
        }

    };

    $.fn.nestable = function(params)
    {
        var lists  = this,
            retval = this;

        lists.each(function()
        {
            var plugin = $(this).data("nestable");

            if (!plugin) {
                $(this).data("nestable", new Plugin(this, params));
                $(this).data("nestable-id", new Date().getTime());
            } else {
                if (typeof params === 'string' && typeof plugin[params] === 'function') {
                    retval = plugin[params]();
                }
            }
        });

        return retval || lists;
    };

})(window.jQuery || window.Zepto, window, document);

$(document).ready(function() {
	$('.dd').nestable('serialize', null, 4);
});
</script>
<style type="text/css">
/**
 * Nestable
 */
.dd { position: relative; display: block; margin: 0; padding: 0; list-style: none; font-size: 13px; line-height: 20px; }
.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }
.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }
.dd-handle { display: block; height: 40px; margin: 5px 0; padding: 10px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }
.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }
.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #fff; border: 2px dashed #222; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 2px dashed #222; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}
.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}
/**
 * Nestable Extras
 */
.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }
#nestable-menu { padding: 0; margin: 20px 0; }
#nestable-output,
#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }
#nestable2 .dd-handle {
    color: #fff;
    border: 1px solid #999;
    background: #bbb;
    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
    background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }
@media only screen and (min-width: 700px) {
    .dd + .dd { margin-left: 2%; }
}
.dd-hover > .dd-handle { background: #2ea8e5 !important; }
/**
 * Nestable Draggable Handles
 */
.dd-content { display: block; height: 40px; margin: 5px 0; padding: 10px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-content:hover { color: #2ea8e5; background: #fff; }
.dd-dragel > .dd3-item > .dd3-content { margin: 0; }
.dd-item > button { margin-left: 30px; }
.dd-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #428bca;
    background: -webkit-linear-gradient(top, #428bca 0%, #357ebd 100%);
    background:    -moz-linear-gradient(top, #428bca 0%, #357ebd 100%);
    background:         linear-gradient(top, #428bca 0%, #357ebd 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
	color: #fff;
	font-size:16px;
	padding-left:6px;
}
.dd-handle:before { content: ''; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd-handle:hover { background: #ddd; }
</style>
<script type="text/javascript">
 var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

$('.dd').on('change', updateOutput);

updateOutput($('#nestable').data('output', $('#json_menu_data')));
</script>
<script type="text/javascript">
$(document).on("click", "#save_menu", function()
{
	var menu_data2 = {
			csrf_sharpedgeV320: $("#csrf_protection").val(),
			json_menu_data: $('#json_menu_data').val()
			};

	$.ajax(
	{
		url: "<?php echo site_url();?>/nav_admin/save_items",
		type: "POST",
		data: menu_data2,
		success: function(msg)
		{
			$('#load_menu_items').html('<div class="admin_ajax text-center"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div');
			var menu_data = {
				csrf_sharpedgeV320: $("#csrf_protection").val(),
				menu_id: $('#menu_id').val()
			};

			$.ajax(
			{
				url: "<?php echo site_url();?>/nav_admin/manage_menu_items",
				type: "POST",
				data: menu_data,
				success: function(msg)
				{
					$('#load_menu_items').html(msg);
				}
			})
		}
	})
});
</script>
<input type="hidden" name="json_menu_data" id="json_menu_data" />
<?php foreach($menu_items->result_array() as $mi):?>
<?php endforeach;?>
<?php //echo "<pre>";?>
<?php //print_r($mi);?>
<?php //echo "</pre>";?>
<div id="menu_array"></div>
<div id="nestable" class="dd">
    <ol class="dd-list">
	<?php foreach($menu_items->result() as $mi):?>
	<?php if($mi->parent_id == 0):?>
        <li class="dd-item" data-id="<?php echo $mi->id;?>">
            <div class="dd-handle"><span class="glyphicon glyphicon-align-justify"></span></div>
			<div class="dd-content"><?php echo $mi->text;?>
			<div class="pull-right">
			<a class="btn btn-xs btn-default" role="button" data-toggle="collapse" href="#collapseEdit-<?php echo $mi->id;?>" aria-expanded="false" aria-controls="collapseEdit-<?php echo $mi->id;?>"><span class="glyphicon glyphicon-pencil"></span></a>
			<a class="btn btn-xs btn-danger" onClick="return confirm('Are you sure? Deleting a menu item will delete all items under it as well!')" href="<?php echo site_url();?>/nav_admin/delete_menu_item/<?php echo $mi->id;?>"><span class="glyphicon glyphicon-trash"></span></a>
			</div>
			</div>
			<script type="text/javascript">
			$('#collapseEdit-<?php echo $mi->id;?>').on('shown.bs.collapse', function () {
			$('#collapseEdit-<?php echo $mi->id;?>').html('<div class="admin_ajax text-center"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div');
			var edit_data = {
				csrf_sharpedgeV320: $("#csrf_protection").val(),
				item_id: <?php echo $mi->id;?>
			};

			$.ajax(
			{
				url: "<?php echo site_url();?>/nav_admin/edit_menu_item",
				type: "POST",
				data: edit_data,
				success: function(msg)
				{
					$('#collapseEdit-<?php echo $mi->id;?>').html(msg);
				}
			})
			});
			
			$('#collapseEdit-<?php echo $mi->id;?>').on('hidden.bs.collapse', function () {
				$('#collapseEdit-<?php echo $mi->id;?>').html('');
			});
			</script>
			<div class="collapse" id="collapseEdit-<?php echo $mi->id;?>">
			</div>
	<?php endif;?>
	<?php if($mi->has_child == 'Y'):?>
			<ol class="dd-list">
	<?php foreach($menu_items->result() as $smi):?>
	<?php if($smi->parent_id == $mi->id AND $smi->child_id == '0'):?>
                <li class="dd-item" data-id="<?php echo $smi->id;?>">
                    <div class="dd-handle"><span class="glyphicon glyphicon-align-justify"></span></div>
					<div class="dd-content"><?php echo $smi->text;?>
					<div class="pull-right">
					<a class="btn btn-xs btn-default" role="button" data-toggle="collapse" href="#collapseEdit-<?php echo $smi->id;?>" aria-expanded="false" aria-controls="collapseEdit-<?php echo $smi->id;?>"><span class="glyphicon glyphicon-pencil"></span></a>
					<a class="btn btn-xs btn-danger" onClick="return confirm('Are you sure? Deleting a menu item will delete all items under it as well!')" href="<?php echo site_url();?>/nav_admin/delete_menu_item/<?php echo $smi->id;?>"><span class="glyphicon glyphicon-trash"></span></a>
					</div>
					</div>
					<script type="text/javascript">
					$('#collapseEdit-<?php echo $smi->id;?>').on('shown.bs.collapse', function () {
					$('#collapseEdit-<?php echo $smi->id;?>').html('<div class="admin_ajax text-center"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div');
					var edit_data = {
						csrf_sharpedgeV320: $("#csrf_protection").val(),
						item_id: <?php echo $smi->id;?>
					};

					$.ajax(
					{
						url: "<?php echo site_url();?>/nav_admin/edit_menu_item",
						type: "POST",
						data: edit_data,
						success: function(msg)
						{
							$('#collapseEdit-<?php echo $smi->id;?>').html(msg);
						}
					})
					});
					
					$('#collapseEdit-<?php echo $smi->id;?>').on('hidden.bs.collapse', function () {
						$('#collapseEdit-<?php echo $smi->id;?>').html('');
					});
					</script>
					<div class="collapse" id="collapseEdit-<?php echo $smi->id;?>">
					</div>
                <?php if($smi->has_sub_child == 'Y'):?>
						<ol class="dd-list">
				<?php foreach($menu_items->result() as $smi2):?>
				<?php if($smi2->parent_id == $smi->id):?>
							<li class="dd-item" data-id="<?php echo $smi2->id;?>">
								<div class="dd-handle"><span class="glyphicon glyphicon-align-justify"></span></div>
								<div class="dd-content"><?php echo $smi2->text;?>
								<div class="pull-right">
								<a class="btn btn-xs btn-default" role="button" data-toggle="collapse" href="#collapseEdit-<?php echo $smi2->id;?>" aria-expanded="false" aria-controls="collapseEdit-<?php echo $smi2->id;?>"><span class="glyphicon glyphicon-pencil"></span></a>
								<a class="btn btn-xs btn-danger" onClick="return confirm('Are you sure? Deleting a menu item will delete all items under it as well!')" href="<?php echo site_url();?>/nav_admin/delete_menu_item/<?php echo $smi2->id;?>"><span class="glyphicon glyphicon-trash"></span></a>
								</div>
								</div>
								<script type="text/javascript">
								$('#collapseEdit-<?php echo $smi2->id;?>').on('shown.bs.collapse', function () {
								$('#collapseEdit-<?php echo $smi2->id;?>').html('<div class="admin_ajax text-center"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div');
								var edit_data = {
									csrf_sharpedgeV320: $("#csrf_protection").val(),
									item_id: <?php echo $smi2->id;?>
								};

								$.ajax(
								{
									url: "<?php echo site_url();?>/nav_admin/edit_menu_item",
									type: "POST",
									data: edit_data,
									success: function(msg)
									{
										$('#collapseEdit-<?php echo $smi2->id;?>').html(msg);
									}
								})
								});
								
								$('#collapseEdit-<?php echo $smi2->id;?>').on('hidden.bs.collapse', function () {
									$('#collapseEdit-<?php echo $smi2->id;?>').html('');
								});
								</script>
								<div class="collapse" id="collapseEdit-<?php echo $smi2->id;?>">
								</div>
							<?php if($smi2->has_sub_child == 'Y'):?>
									<ol class="dd-list">
							<?php foreach($menu_items->result() as $smi3):?>
							<?php if($smi3->child_id == $smi2->id):?>
										<li class="dd-item" data-id="<?php echo $smi3->id;?>">
											<div class="dd-handle"><span class="glyphicon glyphicon-align-justify"></span></div>
											<div class="dd-content"><?php echo $smi3->text;?>
											<div class="pull-right">
											<a class="btn btn-xs btn-default" role="button" data-toggle="collapse" href="#collapseEdit-<?php echo $smi3->id;?>" aria-expanded="false" aria-controls="collapseEdit-<?php echo $smi3->id;?>"><span class="glyphicon glyphicon-pencil"></span></a>
											<a class="btn btn-xs btn-danger" onClick="return confirm('Are you sure? Deleting a menu item will delete all items under it as well!')" href="<?php echo site_url();?>/nav_admin/delete_menu_item/<?php echo $smi3->id;?>"><span class="glyphicon glyphicon-trash"></span></a>
											</div>
											</div>
											<script type="text/javascript">
											$('#collapseEdit-<?php echo $smi3->id;?>').on('shown.bs.collapse', function () {
											$('#collapseEdit-<?php echo $smi3->id;?>').html('<div class="admin_ajax text-center"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div');
											var edit_data = {
												csrf_sharpedgeV320: $("#csrf_protection").val(),
												item_id: <?php echo $smi3->id;?>
											};

											$.ajax(
											{
												url: "<?php echo site_url();?>/nav_admin/edit_menu_item",
												type: "POST",
												data: edit_data,
												success: function(msg)
												{
													$('#collapseEdit-<?php echo $smi3->id;?>').html(msg);
												}
											})
											});
											
											$('#collapseEdit-<?php echo $smi3->id;?>').on('hidden.bs.collapse', function () {
												$('#collapseEdit-<?php echo $smi3->id;?>').html('');
											});
											</script>
											<div class="collapse" id="collapseEdit-<?php echo $smi3->id;?>">
											</div>
										</li>
							<?php endif;?>
							<?php endforeach;?>
									</ol>
									</li>
							<?php else:?>
								</li>
							<?php endif;?>
				<?php endif;?>
				<?php endforeach;?>
						</ol>
						</li>
				<?php else:?>
					</li>
				<?php endif;?>
	<?php endif;?>
	<?php endforeach;?>
			</ol>
			</li>
	<?php else:?>
		</li>
	<?php endif;?>
	<?php endforeach;?>	
    </ol>
</div>
<div class="clearfix"></div><br />
<?php foreach($current_menu->result() as $cm):?>
<?php $is_default = $cm->default_nav;?>
<?php $default_id = $cm->menu_id;?>
<?php endforeach;?>
<div class="pull-left"><a id="save_menu" class="btn btn-primary"><?php echo $this->lang->line('label_submit');?></a></div>
<div class="pull-right">
<?php if($is_default == 'N'):?>
<a class="btn btn-warning" href="<?php echo site_url();?>/nav_admin/set_as_default/<?php echo $default_id;?>"><?php echo $this->lang->line('label_set_default');?></a>
<?php else:?>
<a class="btn btn-warning" disabled="disabled" href="#"><?php echo $this->lang->line('label_set_default');?></a>
<?php endif;?>

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('label_new_nav');?></button>
<a class="btn btn-danger" onClick="return confirm('Are you sure? Deleting a menu will delete all items under it as well!')" href="<?php echo site_url();?>/nav_admin/delete_menu/<?php echo $default_id;?>"><?php echo $this->lang->line('label_delete');?></a>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('label_new_nav');?></h4>
      </div>
      <div class="modal-body">
			<?php echo form_open(site_url() . '/nav_admin/add_menu');?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
			<input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" />
			</div>
			<div class="clearfix"></div><br />
			<div class="text-center"><input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('label_submit');?>" /></div>
			<?php echo form_close();?>
      </div>
    </div>
  </div>
</div>