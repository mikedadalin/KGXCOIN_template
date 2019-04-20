encoding = "utf-8"
# Require any additional compass plugins here.

# Set this to the root of your project when deployed:
project_path = "web"
http_path = "../"
css_dir = "assets/style"
sass_dir = ""
sass_path = "sass"
images_dir = "images"
images_path = project_path + "/assets/" + images_dir
generated_images_path = project_path + "/assets/" + images_dir
javascripts_dir = "assets/js"

# normalize css
# require 'compass-normalize'

# You can select your preferred output style here (can be overridden via the command line):
# output_style = :expanded or :nested or :compact or :compressed
# environment = :production
environment = :development
# output_style = (environment == :production) ? :compressed : :nested
output_style = (environment == :production) ? :compressed : :compact

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
line_comments = false

# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass sass scss && rm -rf sass && mv scss sass

# Debug for firesass
sass_options = {:debug_info => false}