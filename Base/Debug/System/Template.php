<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Debug\System;

/**
 * @codeCoverageIgnore
 * @codingStandardsIgnoreFile
 */
class Template
{
    public static $varWrapper = '<div class="awd-base-debug-wrapper"><code>%s</code></div>';

    public static $string = '"<span class="awd-base-string">%s</span>"';

    public static $var = '<span class="awd-base-var">%s</span>';

    public static $arrowsOpened =  '<span class="awd-base-arrow" data-opened="true">&#x25BC;</span>
        <div class="awd-base-array">';

    public static $arrowsClosed = '<span class="awd-base-arrow" data-opened="false">&#x25C0;</span>
        <div class="awd-base-array awd-base-hidden">';

    public static $arrayHeader = '<span class="awd-base-info">array:%s</span> [';

    public static $array = '<div class="awd-base-array-line" style="padding-left:%s0px">
            %s  => %s
        </div>';

    public static $arrayFooter = '</div>]';

    public static $arrayKeyString = '"<span class="awd-base-array-key">%s</span>"';

    public static $arrayKey = '<span class="awd-base-array-key">%s</span>';

    public static $arraySimpleVar = '<span class="awd-base-array-value">%s</span>';

    public static $arraySimpleString = '"<span class="awd-base-array-string-value">%s</span>"';

    public static $objectHeader = '<span class="awd-base-info" title="%s">Object: %s</span> {';

    public static $objectMethod = '<div class="awd-base-object-method-line" style="padding-left:%s0px">
            #%s
        </div>';

    public static $objectMethodHeader = '<span style="margin-left:%s0px">Methods: </span>
        <span class="awd-base-arrow" data-opened="false">◀</span>
        <div class="awd-base-array  awd-base-hidden">';

    public static $objectMethodFooter = '</div>';

    public static $objectFooter = '</div> }';

    public static $debugJsCss = '<script>
            var awdToggle = function() {
                if (this.dataset.opened == "true") {
                    this.innerHTML = "&#x25C0";
                    this.dataset.opened = "false";
                    this.nextElementSibling.className = "awd-base-array awd-base-hidden";
                } else {
                    this.innerHTML = "&#x25BC;";
                    this.dataset.opened = "true";
                    this.nextElementSibling.className = "awd-base-array";
                }
            };
            document.addEventListener("DOMContentLoaded", function() {
                arrows = document.getElementsByClassName("awd-base-arrow");
                for (i = 0; i < arrows.length; i++) {
                    arrows[i].addEventListener("click", awdToggle,false);
                }
            });
        </script>
        <style>
            .awd-base-debug-wrapper {
                background-color: #263238;
                color: #ff9416;
                font-size: 13px;
                padding: 10px;
                border-radius: 3px;
                z-index: 1000000;
                margin: 20px 0;
            }
            .awd-base-debug-wrapper code {
                background: transparent !important;
                color: inherit !important;
                padding: 0;
                font-size: inherit;
                white-space: inherit;
            }
            .awd-base-info {
                color: #82AAFF;
            }
            .awd-base-var, .awd-base-array-key {
                color: #fff;
            }
            .awd-base-array-value {
                color: #C792EA;
                font-weight: bold;
            }
            .awd-base-arrow {
                cursor: pointer;
                color: #82aaff;
            }
            .awd-base-hidden {
                display:none;
            }
            .awd-base-string, .awd-base-array-string-value {
                font-weight: bold;
                color: #c3e88d;
            }
            .awd-base-object-method-line {
                color: #fff;
            }
        </style>';
}
