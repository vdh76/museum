README
------
README for the Image effect text module.

Author Erwin Derksen (fietserwin: http://drupal.org/user/750928)


Dependencies
------------
Hard dependencies:
- Imagecache actions.
- Image (Drupal core).

Soft dependencies/recommended modules:
- Imagemagick (preferred toolkit).
- PHP filter (Drupal core).


Toolkit
-------
Personally, I prefer the imagemagick toolkit: 
- It is better in anti-aliasing, try to rotate an image using both toolkits and
  you will see what I mean.
- It does not execute in the PHP memory space, so is not restricted by the
  memory_limit PHP setting.
- The GD toolkit will, at least on my Windows configuration, keep the font file
  open after a text operation, so you cannot delete, move or rename it anymore.   
- This module does a better job with Imagemagick (see below).


Installing
----------
As usual. After enabling the module you can add texts to images. This image
effect works with both the GD and imagemagick toolkit, though results differ
depending on the tookit you use.


More information about the effect data options
----------------------------------------------

Font
----
You have to supply the font file to use. The font type supported depend on the
toolkit in use, but at least ttf files will always work. This option accepts
either:

1 of the (enabled) scheme's:
- public://
- private:// Preferred for site specific masks, overlay's, etc, that do not need
    to be shared publicly.
- module://{module_name}/{resource-name} Introduced by the imagecache_actions
    module and preferred for module provided resources, like the button overlay
    of the Video Embed Field Overlay module
    (http://drupal.org/project/video_embed_field_overlay).
- temporary:// Unlikely to be useful, but supported anyway as all schemes are
    supported.

or a relative (to the current directory, probably Drupal root) or absolute path.


Text position
-------------
The text position defines the point in the image where you want to place (align)
your text. It starts at the top left corner of the image with postion 0,0 and
the positive directions are to the right and down.

The definition of the vertical position differs per toolkit. For GD it is the
position of the font baseline, while for Imagemagick it is the bottom of the 
bounding box, i.e the descender or beard line in typography terminology.


Text alignment
--------------
You can align your text with regard to the text position. Possible horizontal
alignments are left (default), center and right. Vertical alignments are top,
center and bottom (default).

Note: Given
- the way that GD uses the vertical text position (as baseline),
- and the way this module implements (vertical) alignment (translating the
  (vertical) position using the calculated bounding box),
vertical alignment with the GD toolkit is a bit off. You will have to compensate  
for this yourself.


Rotation
--------
The text can be rotated before being overlaid on the image. The vlaue is in
degrees, so 90 degrees is straight down. Positive values are rotated clockwise,
negative values counter clockwise.  

In Imagemagick the text is rotated around the text position. Thus centered text
is rotated around its own center. GD, on the other hand, always rotates around
the left bottom (baseline) position, regardless the text alignment. Using
rotation with a non default alignment (left bottom) will give surprising
results.


Text source
-----------
Note: this module is not build to handle multi line texts. Not when the text
contains new lines and/or carriage returns, and not to split a given text over
multiple lines given an available width. Using "\n" in GD seems to work though.

The text to place on the image may come from different sources:
- Static: the text to place on the image is static and is defined in the image
  effect data. Use this e.g. for a fixed copyright notice.
- PHP: the text to place on the iamge comes from a piece of PHP code that should
  return the text to place on the image. Only users with the 'use PHP for
  settings' permission are allowed to use this source. This permission and the
  evaluation of the PHP code come from the PHP filter module which is part of
  Drupal core and thus needs to be enabled, also during image generation. 
- To alleviate the need to enable the PHP filter module, 2 commonly used sources
  for dynamic texts are directly available without any coding, namely the alt
  and title properties of the image field linked to the image at hand. Note that
  multiple image fields, possibly in different languages, may be referring to
  the image that is being processed. This module will take the first image field
  it finds to extract the alt and title. If the field in itself is multi
  lingual, thus not a synced field, the current language will be taken, which is
  the language of the user that happens to request this styled image first.


PHP snippets to determine the text
----------------------------------
Given the correct permission, you can write your own PHP snippet to compute the
text to display. To ease this task, this module makes some information regarding
the image being processed available in 2 variables: $image and $image_context.
These variables are readily available in your snippet.

$image is an associative array containing:  
- source: string, the source of the image, e.g. public://photo.jpg
- info: array, example data:
   - width (int) 180
   - height  (int) 180
   - extension (string) png
   - mime_type (string) image/png
   - file_size (int) 4417
- toolkit: string, imagemagick or GD

$image_context is an associative array containing:
- effect_data: array, the data of this image effect, example data for the text
  effect:
   - size  (string) 12
   - xpos  (string) center
   - ypos  (string) center
   - halign  (string) left
   - valign  (string) bottom
   - RGB Array [1]
      - HEX (string) 000000
      - alpha (string) 100
   - angle (string) 0
   - fontfile  (string:10) lhandw.ttf
   - text_source   (string) text
   - text  (string) Hello World!
   - php  (string) return 'Hello World!'
- managed_file: object|null. A managed file object containing these properties:
   - fid (string) 2
   - uid (string) 1
   - filename  (string) photo.jpg
   - uri (string) public://photo.jpg
   - filemime  (string) image/jpeg
   - filesize  (string) 445751
   - status  (string) 1
   - timestamp (string) 1327525851
   - metatags  Array [0]
   - rdf_mapping Array [0]
- referring_entities: array|null. A nested array with (fully loaded) entities
  referring to the current image. The 1st level of entries is keyed by the field
  name, the 2nd by entity type, and the 3rd by entity id. Example data:
   - field_photo Array [1]
      - node  Array [1]
         - 12  Object of: stdClass
            - nid (string) 12
            - vid (string) 12
            - type  (string) page
            - author ...
            - timestamp ...
            - ...
- entity: object|null, the 1st entity in referring_entities. This is for easy
  access to the referring entity if it may be assumed that only 1 entity is
  referring to the current image.
- image_field: array|null, the 1st image field in entity that is referring to
  the current image. This is for easy access to the image field data if it may
  be assumed that only 1 image field is referring to the current image. Example
  data:
   - fid (int) 2
   - alt (string) ...
   - title (string) ...
   - ...

Of course there are many other possible useful globals. Think of:
- base_url
- base_path
- base_root
- is_https
- user
- language
and of course $_SERVER and $_GET.

Using these information you can access entity data as follows:

Specific case (1 entity, of known entity_type, referring to the image):
<?php
$entity_type = 'node';
$field_name = 'my_field';
$entity = $image_context['entity'];
$field = field_get_items($entity_type, $entity, $field_name);
?>

Or the more general case (not knowing the referring type, or multiple entities
that may be referring to the image):
<?php
$referring_entities = $image_context['referring_entities'];
foreach ($referring_entities as $field_name => $field_referring_entities) {
  foreach ($field_referring_entities as $entity_type => $entities) {
    foreach ($entities as $entity_id => $entity) {
      $field = field_get_items($entity_type, $entity, $field_name);
    }
  }
}
?>

TODO
----
- Vertical alignment: add baseline as vertical alignment and make both toolkits
  behave the same for any given vertical alignment.
- Rotation and alignment. Imagemagick seems to be more correct. Can GD made to
  do the same?
- Language and alt/title: what if the first user to pass by and that generates
  the image is in a language that has no alt/title?
- Newlines: seem to work in GD, not in Imagemagick.

To quote http://www.imagemagick.org/Usage/text/#draw:
As of IM version 6.2.4, the "-draw text" operation no longer understands the use
of '\n' as meaning newline, or the use of percent '%' image information escapes.
(See Drawing a Percent Bug). These abilities, and problems, however remain
available in the new IM v6 operator "-annotate". See the Annotate Text Drawing
Operator below.
