== Structured Content (JSON-LD) #wpsc ==

Contributors: gorbo,antonioleutsch
Tags: json-ld,FAQPage,LocalBusiness,JobPosting,Event,Course,Person,wpsc,structured content
Donate link: https://paypal.me/antonioleutsch
Requires at least: 5.0
Tested up to: 6.1.1
Requires PHP: 7.0
Stable tag: 1.5.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add flexible content boxes with JSON-LD microdata output according to schema.org e.g. FAQPage or JobPosting. It's your chance to beat the competition and for higher rank results – SEO for winners. Gutenberg ready! #wpsc

== Installation ==

1. Unzip the download package
2. Upload structured-content to the /wp-content/plugins/ directory
3. Activate the plugin through the 'Plugins' menu in WordPress

Alternatively
1. upload the zip file from the Admin plugins page
2. then activate

== What does it do ==
With this plugin you can insert structured data elements multiple times in any post or page.

In simple dialogs, for example FAQ can be inserted. Because the the plugin renders the given information as JSON-LD according to schema.org, the bots of the search engines, like google, recognize this schema.
Nice option: you can decide if only the JSON-LD should be displayed in the source code or if the content should be preformatted and visible. Check or uncheck the \"Render HTML\" box to do this.

You can test whether the information has been labeled correctly with the [Markup Validator Tool](https://validator.schema.org/), for example.

The basic goal is that your content can be better understood by the algorithms of different search engines.
A special goal is, among other things, that your answers to questions from Google can be displayed as featured snippets in the SERPs (position 0) or extend your existing snippet in the SERPs.

**The plugin is optimized for the Gutenberg editor and future new structural elements will only be published as Gutenberg blocks. Actually most of the structured content elements also work with the TinyMCE!**

Currently the plugin offers six structured data elements:
- FAQPage
- JobPosting
- LocalBusiness
- Person
- Event
- Course

Structure your content now and MAKE CONTENT GREAT AGAIN! #wpsc

== How to use it ==
Once the the plugin is installed and activated, you'll find a new icon in the titlebar of the WYSIWYG editor. Just click it, select your preferred structured content element you want to insert and a modal will open. Fill out the form, click the save button and your done.

If you use *Gutenberg* you'll find a new content block. Choose your preferred structured content element and fill out the form. If you want to answer more than one question, then simply add them by clicking on "Add one" *within* this Gutenberg block.

Alternatively use these shortcodes in your TinyMCE:

**FAQPage**
*Single FAQ*
> [sc_fs_faq sc_id="fs_faqUniqueID" html="true/false" headline="p or h2-h6" img="img-id-231" question="your question" img_alt="img-alt text" css_class="your-class"]Your answer – you can format it as you want[/sc_fs_faq]

*Multi FAQ*
> [sc_fs_multi_faq headline-0="h3" question-0="Your question 1" answer-0="Your answer 1" image-0="" headline-1="h3" question-1="Your question 2" answer-1="Your answer 2" image-1="" headline-2="h2" question-2="Your question 3" answer-2="Your answer 3" image-2="" count="3" html="false" css_class="your-class"]

**JobPosting**
> [sc_fs_job html="true/false" title="JobPosting Title" title_tag="p or h2-h6" description="JobPosting Description" valid_through="2022-11-08" employment_type="FULL_TIME" company_name="Your Company" same_as="https://gorbo.de" logo_id="309" street_address="anystreet 4" address_locality="Any City" address_region="DE-ST" postal_code="01234" address_country="DE" currency_code="EUR" quantitative_value="200" base_salary="HOUR" css_class="your-class"]

**Event**
> [sc_fs_event html="true/false" title="Event title" title_tag="p or h2-h6" event_location="Event location" status="EventScheduled" event_attendance_mode="OfflineEventAttendanceMode" start_date="2022-08-22T10:25" end_date="2022-08-22T11:25" street_address="Any Street" address_locality="Any City" address_region="DE-ST" postal_code="Any Postal Code" address_country="US" image_id="" performer="PerformingGroup" performer_name="John Doe" offer_availability="InStock" offer_url="https://example.com" currency_code="EUR" price="40.00" offer_valid_from="2022-08-20T10:25" css_class="your-class"]Event description – you can format it as you want[/sc_fs_event]

**Course**
> [sc_fs_course html="true/false" title="Course title" title_tag="p or h2-h6" provider_name="Provider Name" provider_same_as="https://example.com" css_class="your-class" ]Course-Description – you can format it as you want[/sc_fs_course]

**Person**
> [sc_fs_person html="true/false" person_name="John Doe" job_title="CEO of Something" image_id="24" street_address="Any Street" address_locality="Any City" address_region="DE-ST" postal_code="06114" address_country="DE" email="john-doe@example.com" url="https://example.com" telephone="0049-123-45678" css_class="your-class" colleague="https://url.com/about-colleague.html" works_for_name="Company ABC" works_for_alt="Cool Company ABC" works_for_url="https://company-abc.xyz" works_for_logo="https://company-abc.xyz/logo.jpg" same_as="https://linkedin.com/profile/"]

== Updates ==
We will continuously offer new structured data elements and deliver them as updates. Please visit https://wpsc-plugin.com/changelog/ to get the latest information.

[Follow us on twitter @wpsc_plugin](https://twitter.com/wpsc_plugin) to be informed about updates & get the latest news!

== Screenshots ==
1. Adding a FAQPage section.
2. Adding a JobPosting
3. Adding a Event
4. Adding a FAQPage section in Gutenberg

== Changelog ==

= 1.5.3 =
* [PATCH] Custom Escaping Function for JSON-LD
* [PATCH] Custom Strip Tags Function for JSON-LD

= 1.5.2 =
* [PATCH] Wrong Escaping of HTML in FAQPage JSON-LD

= 1.5.1 =
* [PATCH] Compatibility with WP 6.1.1
* [SECURITY] Escaping Output of Blocks and Shortcodes

= 1.5 =
* [FEATURE] New Gutenberg block LocalBusiness
* [FEATURE] Option to add anchors to all headings (id="#")
* [FEATURE] JobPosting: add JobLocationType TELECOMMUTE
* [FEATURE] JobPosting: add employmentTypes FULL_TIME & PART_TIME
* [FEATURE] Nicer animation for FAQ FE Summary
* [FEATURE] Setting additional CSS classes via the Gutenberg standard
* [FIX] Testing of different Bundler
* [FIX] Remove Last One Button removes all faqs in multiple faq section

= 1.4.6 =
* [FEATURE] links in FE for phone, mail & url
* [FIX] little CSS things here and there
* [FIX] better datepicker
* [FIX] invalid JSON – thanks @gefruckelt
* [FIX] empty JSON strings in JOB block
* [FIX] translation in EVENT block

= 1.4.5 =
* [FEATURE] “InnerBlocks” instead of “RichText” in Gutenberg. Goal: already formatted text can be copied into the text
  field and formatting is applied.
* [FEATURE] offer list item for FAQ-Gutenberg block
* [FEATURE] alternate name for person
* [FIX] missing or wrong translations
* [FIX] correct datetimes for some snippets
* [FIX] removed mailto from mail links in person snippet
* [FIX] border-box resizing in frontend

= 1.4.4 =
* [FIX] Timezone added for Event Dates
* [FIX] Timezone added for Job Dates

= 1.4.3 =
* [NEW] eventStatus, eventAttendanceMode for Event-Element (Tiny-MCE & Gutenberg)
* [NEW] SameAs, WorksFor for Person-Element (Tiny-MCE & Gutenberg)

= 1.4.2 =
* [FIX] translation now works in lightboxmodal for tinyMCE
* [FIX] output of incorrectly nested HTML within JSON-LD

= 1.4.1 =
* [FIX] Backend issues with the lightbox modal
* [FEATURE] jQuery completely removed from the plugin

= 1.4.0 =
* [NEW] Structured element "Course" (Gutenberg & TinyMCE)
* [NEW] Icon set (https://www.zondicons.com/)
* [NEW] Update mechanism for blocks
* [NEW] Optional fields for "Events": image, offers, performer
* [FIX] "Events" description in JSON works now :)
* [FIX] Refactored css classes that started with sc- to sc_
* [FIX] Issue with select fields in Gutenberg
* [FIX] Some improvements of the lightbox modal

= 1.3.1 =
* [FIX] for FAQ &gt;10 (thanks to WOLFER MEDIA, tobias.grasse)

= 1.3.0 =
* [NEW] Multi FAQ (Gutenberg & TinyMCE)
* [NEW] Datepicker for Events

= 1.2.0 =
* [New] Person as structured element
* [NEW] Event as  structured element
* [FIX] escape links

= 1.0.0 =
* Complete rewrite
* Thanks for your support: codemacher, web/dev/media, pixeldreher, superguppi

Please visit [https://gitlab.com/webwirtschaft/structured-content/activity](https://gitlab.com/webwirtschaft/structured-content/activity) to see detailed changes.

== Sponsoring ==
If you want a special structured data element, we can implement it especially for your needs. As a sponsor you will be mentioned on the website, the plugin description and the changelog. If you are interested, write us an e-mail *infoⒶwpsc-plugin.com*

== Frequently Asked Questions ==
= Where do i find some HowTo =
Please check out our ["HowTo" section](https://wpsc-plugin.com/how-to/) on our website.

= Where i can report bugs? =
Please use the ["Issue" section](https://gitlab.com/webwirtschaft/structured-content/issues) of the gitlab page of the Plugin.
