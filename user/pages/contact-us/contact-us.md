---
title: "Contact Us"
form:
  name: contact-us-form
  attributes:
    x-data: contactUsComponent
  fields:
    first_name:
      type: text
      label: "First Name (Given Name)"
      id: "first-name-input"
      label_classes: label
      label_element_classes: label-text
      outerclasses: "mb-4 form-control w-full"
      classes: "input input-bordered w-full"
      validate:
        required: true
        type: text
    last_name:
      type: text
      label: "Last Name (Surname)"
      label_classes: label
      label_element_classes: label-text
      outerclasses: "mb-4 form-control w-full"
      classes: "input input-bordered w-full"
      validate:
        required: true
        type: text
    email:
      type: email
      label: Email
      label_classes: label
      label_element_classes: label-text
      outerclasses: "mb-4 form-control w-full"
      classes: "input input-bordered w-full"
      validate:
        required: true
        type: email

    website:
      type: url
      label: "Website"
      label_classes: label
      label_element_classes: label-text
      placeholder: "https://example.org"
      outerclasses: "form-control w-full mb-4"
      classes: "input input-bordered w-full"

    category:
      type: select
      size: long
      id: "category-input"
      label_classes: label
      label_element_classes: label-text
      outerclasses: "form-control mb-4"
      classes: "select select-bordered w-full"
      label: Category
      options:
        feedback: Feedback
        claim: "Claim a cafe"
        help: Help
        contribute: Contribute
        press: Press
        other: Other

    claim_url:
      type: url
      id: "claim-url-input"
      label: "NomadBeans Cafe Link"
      label_classes: label
      label_element_classes: label-text
      placeholder: "https://nomadbeans.com/us-las-vegas-example-cafe"
      outerclasses: "form-control w-full mb-4 claim-only-form-control"
      classes: "input input-bordered w-full"
      validate:
        type: url

    claim_phone:
      type: tel
      id: "claim-phone-input"
      label: "Claimant Phone Number"
      label_classes: label
      label_element_classes: label-text
      outerclasses: "form-control w-full mb-4 claim-only-form-control"
      classes: "input input-bordered w-full"


    message:
      type: textarea
      autofocus: false
      classes: "textarea textarea-bordered h-24 w-full"
      outerclasses: " form-control mb-4"
      label_classes: label
      label_element_classes: label-text
      label: Message
      minlength: 10
      maxlength: 500
      validate:
        required: true

    claim_info:
      type: display
      size: large
      label: false
      markdown: true
      content: "**Important**: Owners who are claiming a cafe as theirs should provide a detailed message to verify that you indeed own the business. This is often a website with a phone number where you can be reachd, a google link for your business with a phone number where you can reached, or any other helpful information for verifying your identity. Failing to do so will likely result in a denied claim."
      outerclasses: "alert alert-warning shadow-lg claim-info"
      classes: "custom-classes"

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
      fileprefix: review-
      dateformat: Ymd-His-u
      extension: txt
      body: "{% include 'forms/data.txt.twig' %}"
    contact_us: true
    message: "Thank you for your feedback!"
    display: thankyou
featured_image_alt_description: sdfdsf
media_order: michal-parzuchowski-ItaV89TNkks-unsplash.jpeg
---
