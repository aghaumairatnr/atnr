# Changelog

Here we document the development of the plugin and give an outlook on the upcoming version.

## 1.5.3  - 2023-01-12
- [PATCH] Custom Escaping Function for JSON-LD
- [PATCH] Custom Strip Tags Function for JSON-LD

## 1.5.2 - 2022-12-31
- [PATCH] Wrong Escaping of HTML in FAQPage JSON-LD

## 1.5.1 - 2022-12-27

- [PATCH] Compatibility with WP 6.1.1
- [SECURITY] Escaping Output of Blocks and Shortcodes

## 1.5 - 2022-07-08

- [FEATURE] New Gutenberg block LocalBusiness
- [FEATURE] Option to add anchors to all headings (id=\"#\")
- [FEATURE] JobPosting: add JobLocationType TELECOMMUTE
- [FEATURE] JobPosting: add employmentTypes FULL_TIME & PART_TIME
- [FEATURE] Nicer animation for FAQ FE Summary
- [FEATURE] Setting additional CSS classes via the Gutenberg standard
- [FIX] Testing of different Bundler 
- [FIX] Remove Last One Button removes all faqs in multiple faq section

## 1.4.5 - 2020-02-19

- [FEATURE] “InnerBlocks” instead of “RichText” in Gutenberg. Goal: already formatted text can be copied into the text
  field and formatting is applied.
- [FEATURE] Offer list item for FAQ-Gutenberg block
- [FEATURE] Alternate Name for Person
- [FIX] Missing or Wrong Translations
- [FIX] Correct Datetimes for some Snippets
- [FIX] Removed Mailto from Mail Links in Person Snippet
- [FIX] Border Box Resizing in Frontend

## 1.4.4 -

- [FIX] Timezone added for Event Dates``
- [FIX] Timezone added for Job Dates

## 1.4.3 -

- [NEW] eventStatus, eventAttendanceMode for Event-Element (Tiny-MCE & Gutenberg);
  see: https://developers.google.com/search/docs/data-types/event#eventstatus
- [NEW] SameAs, WorksFor for Person-Element (Tiny-MCE & Gutenberg)

## 1.4.2 -

- [FIX] translation now works in lightboxmodal for tinyMCE
- [FIX] output of incorrectly nested HTML within JSON-LD

## 1.4.1 -

- [FIX] Backend issues with the lightbox modal
- [FEATURE] jQuery completely removed from the plugin

## 1.4.0 -

- [NEW] Structured element “Course” (Gutenberg & TinyMCE)
- [NEW] Icon set (https://www.zondicons.com/)
- [NEW] Update mechanism for blocks
- [NEW] Optional fields for “Events”: image, offers, performer
- [FIX] “Events” description in JSON works now 🙂
- [FIX] Refactored css classes that started with sc- to sc_
- [FIX] Issue with select fields in Gutenberg
- [FIX] Some improvements of the lightbox modal

## 1.3.1 -

- [FIX] for FAQ >10 (thanks to WOLFER MEDIA, tobias.grasse)

## 1.3.0 -

- [NEW] Multi FAQ (Gutenberg & TinyMCE)
- [NEW] Datepicker for Events

## 1.2.0 - 2019-07-15

- [New] Person as structured element
- [NEW] Event as structured element
- [FIX] escape links

## 1.0.1 - 2019-06-12

- fixes

## 1.0.0 - 2019-06-12

- Complete rewrite
- Thanks for your support: codemacher, web/dev/media, pixeldreher, superguppi

## 0.11.1 - 2018-10-29

- initial commit
