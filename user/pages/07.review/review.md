---
title: Review
form:
  name: review-form
  attributes:
    x-data: reviewFormComponent
  fields:
    your_details:
      type: section
      title: "Your Details"
      title_level: h2
      classes: "mb-4 mt-8"

    reviewer_name:
      type: text
      id: name
      label: Name
      label_classes: label
      label_element_classes: label-text
      outerclasses: "mb-4 form-control w-full"
      classes: "input input-ghost w-full"
      data-default@: '\Grav\Plugin\Gravel\Utils::getUserFullname'
      disabled: true
      validate:
        required: true

    reviewer_username:
      type: hidden
      evaluate: true
      default: grav.user.username

    reviewer_email:
      type: email
      data-default@: '\Grav\Plugin\Gravel\Utils::getUserEmail'
      id: email
      disabled: true
      label: Email
      label_classes: label
      label_element_classes: label-text
      placeholder: example@example.com
      outerclasses: "form-control w-full mb-4"
      classes: "input input-ghost w-full"
      validate:
        required: true

    reviewer_message:
      type: textarea
      id: message
      label: "Message (Optional)"
      label_element_classes: label-text
      placeholder: "Enter a message"
      classes: "textarea textarea-bordered h-24 w-full"
      outerclasses: " form-control mb-4"
      label_classes: label
      maxlength: 255

    reviewer_is_affilitated:
      type: checkbox
      id: is-affiliated
      label: "I am working for or are affiliated with this cafe."
      outerclasses: mb-4

    cafe_details:
      type: section
      title: "Cafe Details"
      title_level: h2
      classes: "mb-4 mt-8"

    cafe_key:
      type: hidden
      evaluate: true
      default: uri.param('location')

    cafe_name:
      type: text
      id: cafe-name
      data-default@: '\Grav\Plugin\Gravel\Utils::getLocationNameFromUri'
      label: "Cafe Name"
      label_classes: label
      label_element_classes: label-text
      outerclasses: "mb-4 form-control w-full"
      classes: "input input-bordered w-full"
      disabled: true
      validate:
        required: true

    cafe_images:
      type: file
      id: cafe-images
      label: Images
      display_label: true
      label_classes: label
      label_element_classes: label-text
      outer_label_classes: test
      multiple: true
      classes: "!mb-0"
      destination: self@
      random_name: false
      avoid_overwriting: true
      outerclasses: "form-control mb-4"
      filesize: 3
      limit: 10
      accept:
        - "image/*"

    cafe_rating_overall:
      type: range
      id: cafe-rating-overall
      label: "How is the cafe overall?"
      label_classes: label
      label_element_classes: label-text
      classes: "range range-primary"
      outerclasses: "mb-4 form-control w-full"
      validate:
        min: 0
        max: 10

    cafe_rating_coffee:
      type: range
      id: cafe-rating-coffee
      label: "How is the coffee?"
      label_classes: label
      label_element_classes: label-text
      classes: "range range-primary"
      outerclasses: "mb-4 form-control w-full"
      validate:
        min: 0
        max: 10

    cafe_rating_wifi:
      type: range
      id: cafe-rating-coffee
      label: "How is the Wi-Fi?"
      label_classes: label
      label_element_classes: label-text
      classes: "range range-primary"
      outerclasses: "mb-4 form-control w-full"
      validate:
        min: 0
        max: 10

    cafe_rating_price:
      type: range
      id: cafe-rating-coffee
      label: "How is the price?"
      label_classes: label
      label_element_classes: label-text
      classes: "range range-primary"
      outerclasses: "mb-4 form-control w-full"
      validate:
        min: 0
        max: 10

    cafe_rating_seating:
      type: range
      id: cafe-rating-coffee
      label: "How is the seating?"
      label_classes: label
      label_element_classes: label-text
      classes: "range range-primary"
      outerclasses: "mb-4 form-control w-full"
      validate:
        min: 0
        max: 10

    cafe_rating_food:
      type: range
      id: cafe-rating-coffee
      label: "How is the food?"
      label_classes: label
      label_element_classes: label-text
      classes: "range range-primary"
      outerclasses: "mb-4 form-control w-full"
      validate:
        min: 0
        max: 10

    cafe_rating_location:
      type: range
      id: cafe-rating-coffee
      label: "How is the location?"
      label_classes: label
      label_element_classes: label-text
      classes: "range range-primary"
      outerclasses: "mb-4 form-control w-full"
      validate:
        min: 0
        max: 10
        
    cafe_amenities:
      type: text
      label: Features
      id: cafe-amenities
      display_label: false
      outerclasses: form-control
      size: large
      classes: fancy
      help: PLUGIN_ADMIN.TAXONOMY_TYPES_HELP
      validate:
        type: commalist

    

    g-recaptcha-response:
      label: Captcha
      type: captcha
      recaptcha_not_validated: "Captcha not valid!"
      classes: "mx-auto max-w-max"
      outerclasses: "mx-auto max-w-max my-8"

  buttons:
    reset:
      type: reset
      value: Reset
      classes: "btn btn-ghost mr-4"
    submit:
      type: submit
      value: Submit
      classes: "btn btn-primary btn-wide"
  process:
    captcha: true
    save:
      fileprefix: feedback-
      dateformat: Ymd-His-u
      extension: txt
      body: "{% include 'forms/data.txt.twig' %}"
    message: "Thank you for your feedback!"
    display: thankyou
page_media_alt_desc: "a woman making coffee at a counter inside a cafe"
media_order: nafinia-putra-Kwdp-0pok-I-unsplash.jpeg
access:
  site:
    submit: true
---
