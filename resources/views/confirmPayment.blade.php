<?php
/**
 * Created by PhpStorm.
 * User: kirigo karanja
 * Date: 10/07/2018
 * Time: 13:32
 */
?>
        <!DOCTYPE html>
<html>
<head>
    <title>Confirm Payment</title>
    <!--    CSS Links-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"/>
</head>
<body>

@include('navigation bar.nav')

<div style="margin: 10px;">
    <div class="table-container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col"> Booking Id</th>
                <th scope="col"> Booking Name</th>
                <th scope="col"> Branch Time</th>
                <th scope="col"> Vehicle </th>
                <th scope="col"> Package </th>
                <th scope="col"> Service </th>
                <th scope="col"> Customer </th>
                <th scope="col"> Status </th>
                <th scope="col"> Washer </th>
            </tr>
            </thead>
            @foreach($booking as $book)
                <tbody class="table-body">
                <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->book_date}}</td>
                    <td>{{$book->book_time}}</td>
                    <td>{{$book->vehicle_id}}</td>
                    <td>{{$book->package_id}}</td>
                    <td>{{$book->service_id}}</td>
                    <td>{{$book->customer_id}}</td>
                    <td>{{$book->status}}</td>
                    <td>{{$book->washer_id}}</td>
                    <td>
                        <form action="/pay/{{$book->id}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$book->id or ''}}"><br><br>
                            <button type="submit">Confirm Payment</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>

{{--<div style="text-align: center;">--}}

    {{--<table border="1" style="margin-top: 3%">--}}
        {{--<tr>--}}
            {{--<th>Booking Id</th>--}}
            {{--<th>Booking Date </th>--}}
            {{--<th>Booking Time</th>--}}
            {{--<th>Vehicle</th>--}}
            {{--<th>Package</th>--}}
            {{--<th>Service</th>--}}
            {{--<th>Customer</th>--}}
            {{--<th>Status</th>--}}
            {{--<th>Washer</th>--}}
        {{--</tr>--}}
        {{--@foreach($booking as $book)--}}
            {{--<tr>--}}
                {{--<td>{{$book->id}}</td>--}}
                {{--<td>{{$book->book_date}}</td>--}}
                {{--<td>{{$book->book_time}}</td>--}}
                {{--<td>{{$book->vehicle_id}}</td>--}}
                {{--<td>{{$book->package_id}}</td>--}}
                {{--<td>{{$book->service_id}}</td>--}}
                {{--<td>{{$book->customer_id}}</td>--}}
                {{--<td>{{$book->status}}</td>--}}
                {{--<td>{{$book->washer_id}}</td>--}}
                {{--<td>--}}
                    {{--<form action="/pay/{{$book->id}}" method="post" enctype="multipart/form-data">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<input type="hidden" name="id" value="{{$book->id or ''}}"><br><br>--}}
                        {{--<button type="submit">Confirm Payment</button>--}}
                    {{--</form>--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    {{--</table>--}}
{{--</div>--}}
</body>

<style>

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
    }

    li {
        float: left;
    }

    li a, .dropbtn {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover, .dropdown:hover .dropbtn {
        background-color: red;
    }

    li.dropdown {
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {background-color: #f1f1f1}

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

<script>
    (function($, window, undefined) {
        "use strict";

        var name = "stickyTableHeaders",
            id = 0,
            defaults = {
                fixedOffset: 0,
                leftOffset: 0,
                marginTop: 0,
                objDocument: document,
                objHead: "head",
                objWindow: window,
                scrollableArea: window,
                cacheHeaderHeight: false,
                zIndex: 3
            };

        function Plugin(el, options) {
            // To avoid scope issues, use 'base' instead of 'this'
            // to reference this class from internal events and functions.
            var base = this;

            // Access to jQuery and DOM versions of element
            base.$el = $(el);
            base.el = el;
            base.id = id++;

            // Listen for destroyed, call teardown
            base.$el.bind("destroyed", $.proxy(base.teardown, base));

            // Cache DOM refs for performance reasons
            base.$clonedHeader = null;
            base.$originalHeader = null;

            // Cache header height for performance reasons
            base.cachedHeaderHeight = null;

            // Keep track of state
            base.isSticky = false;
            base.hasBeenSticky = false;
            base.leftOffset = null;
            base.topOffset = null;

            base.init = function() {
                base.setOptions(options);

                base.$el.each(function() {
                    var $this = $(this);

                    // remove padding on <table> to fix issue #7
                    $this.css("padding", 0);

                    base.$originalHeader = $("thead:first", this);
                    base.$clonedHeader = base.$originalHeader.clone();
                    $this.trigger("clonedHeader." + name, [base.$clonedHeader]);

                    base.$clonedHeader.addClass("tableFloatingHeader");
                    base.$clonedHeader.css({ display: "none", opacity: 0.0 });

                    base.$originalHeader.addClass("tableFloatingHeaderOriginal");

                    base.$originalHeader.after(base.$clonedHeader);

                    base.$printStyle = $(
                        '<style type="text/css" media="print">' +
                        ".tableFloatingHeader{display:none !important;}" +
                        ".tableFloatingHeaderOriginal{position:static !important;}" +
                        "</style>"
                    );
                    base.$head.append(base.$printStyle);
                });

                base.$clonedHeader.find("input, select").attr("disabled", true);

                base.updateWidth();
                base.toggleHeaders();
                base.bind();
            };

            base.destroy = function() {
                base.$el.unbind("destroyed", base.teardown);
                base.teardown();
            };

            base.teardown = function() {
                if (base.isSticky) {
                    base.$originalHeader.css("position", "static");
                }
                $.removeData(base.el, "plugin_" + name);
                base.unbind();

                base.$clonedHeader.remove();
                base.$originalHeader.removeClass("tableFloatingHeaderOriginal");
                base.$originalHeader.css("visibility", "visible");
                base.$printStyle.remove();

                base.el = null;
                base.$el = null;
            };

            base.bind = function() {
                base.$scrollableArea.on("scroll." + name, base.toggleHeaders);
                if (!base.isWindowScrolling) {
                    base.$window.on("scroll." + name + base.id, base.setPositionValues);
                    base.$window.on("resize." + name + base.id, base.toggleHeaders);
                }
                base.$scrollableArea.on("resize." + name, base.toggleHeaders);
                base.$scrollableArea.on("resize." + name, base.updateWidth);
            };

            base.unbind = function() {
                // unbind window events by specifying handle so we don't remove too much
                base.$scrollableArea.off("." + name, base.toggleHeaders);
                if (!base.isWindowScrolling) {
                    base.$window.off("." + name + base.id, base.setPositionValues);
                    base.$window.off("." + name + base.id, base.toggleHeaders);
                }
                base.$scrollableArea.off("." + name, base.updateWidth);
            };

            // We debounce the functions bound to the scroll and resize events
            base.debounce = function(fn, delay) {
                var timer = null;
                return function() {
                    var context = this,
                        args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function() {
                        fn.apply(context, args);
                    }, delay);
                };
            };

            base.toggleHeaders = base.debounce(function() {
                if (base.$el) {
                    base.$el.each(function() {
                        var $this = $(this),
                            newLeft,
                            newTopOffset = base.isWindowScrolling
                                ? isNaN(base.options.fixedOffset)
                                    ? base.options.fixedOffset.outerHeight()
                                    : base.options.fixedOffset
                                : base.$scrollableArea.offset().top +
                                (!isNaN(base.options.fixedOffset)
                                    ? base.options.fixedOffset
                                    : 0),
                            offset = $this.offset(),
                            scrollTop = base.$scrollableArea.scrollTop() + newTopOffset,
                            scrollLeft = base.$scrollableArea.scrollLeft(),
                            headerHeight,
                            scrolledPastTop = base.isWindowScrolling
                                ? scrollTop > offset.top
                                : newTopOffset > offset.top,
                            notScrolledPastBottom;

                        if (scrolledPastTop) {
                            headerHeight = base.options.cacheHeaderHeight
                                ? base.cachedHeaderHeight
                                : base.$clonedHeader.height();
                            notScrolledPastBottom =
                                (base.isWindowScrolling ? scrollTop : 0) <
                                offset.top +
                                $this.height() -
                                headerHeight -
                                (base.isWindowScrolling ? 0 : newTopOffset);
                        }

                        if (scrolledPastTop && notScrolledPastBottom) {
                            newLeft = offset.left - scrollLeft + base.options.leftOffset;
                            base.$originalHeader.css({
                                position: "fixed",
                                "margin-top": base.options.marginTop,
                                top: 0,
                                left: newLeft,
                                "z-index": base.options.zIndex
                            });
                            base.leftOffset = newLeft;
                            base.topOffset = newTopOffset;
                            base.$clonedHeader.css("display", "");
                            if (!base.isSticky) {
                                base.isSticky = true;
                                // make sure the width is correct: the user might have resized the browser while in static mode
                                base.updateWidth();
                                $this.trigger("enabledStickiness." + name);
                            }
                            base.setPositionValues();
                        } else if (base.isSticky) {
                            base.$originalHeader.css("position", "static");
                            base.$clonedHeader.css("display", "none");
                            base.isSticky = false;
                            base.resetWidth(
                                $("td,th", base.$clonedHeader),
                                $("td,th", base.$originalHeader)
                            );
                            $this.trigger("disabledStickiness." + name);
                        }
                    });
                }
            }, 0);

            base.setPositionValues = base.debounce(function() {
                var winScrollTop = base.$window.scrollTop(),
                    winScrollLeft = base.$window.scrollLeft();
                if (
                    !base.isSticky ||
                    winScrollTop < 0 ||
                    winScrollTop + base.$window.height() > base.$document.height() ||
                    winScrollLeft < 0 ||
                    winScrollLeft + base.$window.width() > base.$document.width()
                ) {
                    return;
                }
                base.$originalHeader.css({
                    top: base.topOffset - (base.isWindowScrolling ? 0 : winScrollTop),
                    left: base.leftOffset - (base.isWindowScrolling ? 0 : winScrollLeft)
                });
            }, 0);

            base.updateWidth = base.debounce(function() {
                if (!base.isSticky) {
                    return;
                }
                // Copy cell widths from clone
                if (!base.$originalHeaderCells) {
                    base.$originalHeaderCells = $("th,td", base.$originalHeader);
                }
                if (!base.$clonedHeaderCells) {
                    base.$clonedHeaderCells = $("th,td", base.$clonedHeader);
                }
                var cellWidths = base.getWidth(base.$clonedHeaderCells);
                base.setWidth(
                    cellWidths,
                    base.$clonedHeaderCells,
                    base.$originalHeaderCells
                );

                // Copy row width from whole table
                base.$originalHeader.css("width", base.$clonedHeader.width());

                // If we're caching the height, we need to update the cached value when the width changes
                if (base.options.cacheHeaderHeight) {
                    base.cachedHeaderHeight = base.$clonedHeader.height();
                }
            }, 0);

            base.getWidth = function($clonedHeaders) {
                var widths = [];
                $clonedHeaders.each(function(index) {
                    var width,
                        $this = $(this);

                    if ($this.css("box-sizing") === "border-box") {
                        var boundingClientRect = $this[0].getBoundingClientRect();
                        if (boundingClientRect.width) {
                            width = boundingClientRect.width; // #39: border-box bug
                        } else {
                            width = boundingClientRect.right - boundingClientRect.left; // ie8 bug: getBoundingClientRect() does not have a width property
                        }
                    } else {
                        var $origTh = $("th", base.$originalHeader);
                        if ($origTh.css("border-collapse") === "collapse") {
                            if (window.getComputedStyle) {
                                width = parseFloat(window.getComputedStyle(this, null).width);
                            } else {
                                // ie8 only
                                var leftPadding = parseFloat($this.css("padding-left"));
                                var rightPadding = parseFloat($this.css("padding-right"));
                                // Needs more investigation - this is assuming constant border around this cell and it's neighbours.
                                var border = parseFloat($this.css("border-width"));
                                width = $this.outerWidth() - leftPadding - rightPadding - border;
                            }
                        } else {
                            width = $this.width();
                        }
                    }

                    widths[index] = width;
                });
                return widths;
            };

            base.setWidth = function(widths, $clonedHeaders, $origHeaders) {
                $clonedHeaders.each(function(index) {
                    var width = widths[index];
                    $origHeaders.eq(index).css({
                        "min-width": width,
                        "max-width": width
                    });
                });
            };

            base.resetWidth = function($clonedHeaders, $origHeaders) {
                $clonedHeaders.each(function(index) {
                    var $this = $(this);
                    $origHeaders.eq(index).css({
                        "min-width": $this.css("min-width"),
                        "max-width": $this.css("max-width")
                    });
                });
            };

            base.setOptions = function(options) {
                base.options = $.extend({}, defaults, options);
                base.$window = $(base.options.objWindow);
                base.$head = $(base.options.objHead);
                base.$document = $(base.options.objDocument);
                base.$scrollableArea = $(base.options.scrollableArea);
                base.isWindowScrolling = base.$scrollableArea[0] === base.$window[0];
            };

            base.updateOptions = function(options) {
                base.setOptions(options);
                // scrollableArea might have changed
                base.unbind();
                base.bind();
                base.updateWidth();
                base.toggleHeaders();
            };

            // Run initializer
            base.init();
        }

        // A plugin wrapper around the constructor,
        // preventing against multiple instantiations
        $.fn[name] = function(options) {
            return this.each(function() {
                var instance = $.data(this, "plugin_" + name);
                if (instance) {
                    if (typeof options === "string") {
                        instance[options].apply(instance);
                    } else {
                        instance.updateOptions(options);
                    }
                } else if (options !== "destroy") {
                    $.data(this, "plugin_" + name, new Plugin(this, options));
                }
            });
        };
    })(jQuery, window);

    $(document).ready(() => {
        $(".table").stickyTableHeaders();
    });

</script>

</html>
