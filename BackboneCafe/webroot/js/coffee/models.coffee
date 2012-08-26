# MODELS
class Cafe extends Backbone.Model
  urlRoot:
    '/cake/cafes'
  defaults:
    tag: ''
  initialize: (attributes, options) ->
    @attributes.createdAt = (new Date).getTime()
      
window.Cafe = Cafe