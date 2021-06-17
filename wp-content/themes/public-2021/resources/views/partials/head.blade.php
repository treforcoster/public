<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <style>

    /* LEGAL DISCLAIMER
 *
 * These Fonts are licensed only for use on these domains and their subdomains:
 * public.london
 *
 * It is illegal to download or use them on other websites.
 *
 * While the @font-face statements below may be modified by the client, this
 * disclaimer may not be removed.
 *
 * Optimo webfonts are protected by copyright law and provided under license. To modify, alter, translate, convert, decode or reverse engineer in any manner whatsoever, including converting the Font Software into a different format is strictly prohibited. The webfont files are not to be used for anything other than web font use.
 *
 * optimo.ch
*/

    /* INSTRUCTIONS
     *
     * Copy the Legal Disclaimer, the domains name and the @font-faces statements to your regular CSS file. The fonts folder(s) should be placed relative to the regular CSS file.
    */

    @font-face {
      font-family: "TheinhardtM";
      src: url(<?php echo get_stylesheet_directory_uri() . '/assets/fonts/Theinhardt-Medium.woff2';?>) format("woff2"), url(<?php echo get_stylesheet_directory_uri() . '/assets/fonts/Theinhardt-Medium.woff';?>) format("woff");
      font-weight: 500;
      font-style: normal;
    }

    @font-face {
      font-family: "TheinhardtR";
      src: url(<?php echo get_stylesheet_directory_uri() . '/assets/fonts/Theinhardt-Regular.woff2';?>) format("woff2"),  url(<?php echo get_stylesheet_directory_uri() . '/assets/fonts/Theinhardt-Regular.woff';?>) format("woff");
      font-weight: 400;
      font-style: normal;
    }


  </style>

  @php wp_head() @endphp
</head>
