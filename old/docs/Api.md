# Phantom API Reference
All of the endpoints come after `/admin/api/`

|Endpoint|Method|Description|
|--------|------|-----------|
|`/records/:project/update/:id`|`POST`|Updates a record for a project. The data must be in the form of HTML formdata.|
|`/records/:project/:datatype/list`|`GET`|Returns a list of records within a project of a certain data type.|