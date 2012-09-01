# MODELS
class Cafe extends Backbone.Model
  urlRoot:
    '/cake/cafes'
  defaults:
    tag: 'coffee'
  initialize: (attributes, options) ->
    @attributes.createdAt = (new Date).getTime()
      
window.Cafe = Cafe