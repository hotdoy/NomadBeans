---
title: Submit
form:
  name: submit-form
  attributes:
    x-data: submitFormComponent
  fields:
    your_details:
      type: section
      title: "Your Details"
      title_level: h2
      classes: "mb-4 mt-8"
    submission_username:
      type: hidden
      label: Username
      evaluate: true
      default: grav.user.username
    user_fullname:
      type: text
      id: name
      label: Name
      label_classes: label
      label_element_classes: label-text
      outerclasses: "mb-4 form-control w-full"
      classes: "input input-bordered w-full"
      validate:
        required: true
    email:
      type: email
      id: email
      label: Email
      label_classes: label
      label_element_classes: label-text
      placeholder: example@example.com
      outerclasses: "form-control w-full mb-4"
      classes: "input input-bordered w-full"
      validate:
        required: true
    message:
      type: textarea
      id: message
      label: "Message (Optional)"
      label_element_classes: label-text
      placeholder: "Enter a message"
      classes: "textarea textarea-bordered h-24 w-full"
      outerclasses: " form-control mb-4"
      label_classes: label
      maxlength: 255
    is_affilitated:
      type: checkbox
      id: is-affiliated
      label: "I am working for or are affiliated with this cafe."
      outerclasses: mb-4
    cafe_details:
      type: section
      title: "Cafe Details"
      title_level: h2
      classes: "mb-4 mt-8"
    name:
      type: text
      id: cafe-name
      label: "Cafe Name"
      label_classes: label
      label_element_classes: label-text
      outerclasses: "mb-4 form-control w-full"
      classes: "input input-bordered w-full"
      validate:
        required: true
    description:
      type: textarea
      id: cafe-description
      label: "Cafe Description"
      label_element_classes: label-text
      placeholder: "Enter a description (Max 500 characters)"
      classes: "textarea textarea-bordered h-24 w-full"
      outerclasses: " form-control mb-4"
      label_classes: label
      maxlength: 500
      validate:
        required: true
    images:
      type: file
      id: cafe-images
      label: Images
      display_label: true
      label_classes: label
      label_element_classes: label-text
      outer_label_classes: test
      multiple: true
      classes: "!mb-0"
      destination: 'image://submissions-tmp'
      random_name: true
      avoid_overwriting: false
      outerclasses: "form-control mb-4"
      filesize: 3
      limit: 10
      accept:
        - "image/*"
    cafe_country:
      type: select
      id: cafe-country
      default: US
      label: Cafe Country
      label_classes: label
      label_element_classes: label-text
      outerclasses: "form-control mb-4"
      classes: "select select-bordered w-full"
      size: long
      data-options@: '\Grav\Plugin\Gravel\Utils::getCountries'
    city:
      type: select
      id: cafe-city
      label: Cafe City
      label_classes: label
      label_element_classes: label-text
      outerclasses: "form-control mb-4"
      classes: "select select-bordered w-full"
      size: long
      validate:
        type: text
      options:
        default: "Select a country to view cities."
    lat:
      type: text
      id: cafe-lat
      help: "To get the latitude and longitude of an address, search for a location on Google Maps and right click the exact position where the cafe is located. You will see the coordinates at the top of the menu that pops up."
      label: "Cafe Latitude"
      label_classes: label
      label_element_classes: label-text
      classes: "input input-bordered w-full"
      outerclasses: "mb-4 form-control w-full"
    lng:
      type: text
      id: cafe-lng
      help: "To get the latitude and longitude of an address, search for a location on Google Maps and right click the exact position where the cafe is located. You will see the coordinates at the top of the menu that pops up."
      label: "Cafe Longitude"
      label_classes: label
      label_element_classes: label-text
      classes: "input input-bordered w-full"
      outerclasses: "mb-4 form-control w-full"
    rating_overall:
      type: range
      id: cafe-rating-overall
      label: "Overall Rating"
      label_classes: label
      label_element_classes: label-text
      classes: "range range-primary"
      outerclasses: "mb-4 form-control w-full"
      validate:
        min: 0
        max: 10
    rating_coffee:
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
    rating_wifi:
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
    rating_price:
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
    rating_seating:
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
    rating_power:
      type: range
      id: cafe-rating-coffee
      label: "How are the power outlets?"
      label_classes: label
      label_element_classes: label-text
      classes: "range range-primary"
      outerclasses: "mb-4 form-control w-full"
      validate:
        min: 0
        max: 10
    rating_location:
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
    amenities:
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
    # g-recaptcha-response:
    #   label: Captcha
    #   type: captcha
    #   recaptcha_not_validated: "Captcha not valid!"
    #   classes: "mx-auto max-w-max"
    #   outerclasses: "mx-auto max-w-max my-8"
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
    captcha: false
    email:
      from: "{{ config.plugins.email.from }}"
      to:
        - "{{ config.plugins.email.to }}"
        - "{{ form.value.email }}"
      subject: "[Feedback] {{ form.value.name|e }}"
      body: "{% include 'forms/data.html.twig' %}"
    message: "Thank you for your feedback!"
    display: thankyou
    cafe_submit: true
page_media_alt_desc: "a woman making coffee at a counter inside a cafe"
media_order: nafinia-putra-Kwdp-0pok-I-unsplash.jpeg
access:
  site:
    submit: true
---
