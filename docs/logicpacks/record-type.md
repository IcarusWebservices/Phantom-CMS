# Record Type
_Represents a type of record within the database._
- - -
## Methods
The methods you can implement in your record type class
### processContent($content)
> This method is declared as abstract and is thus marked as `required`

Takes in the raw text from the `record_content` column in the `ph_records` table, and must transform it into a `PH_Data` object.
- @param `string` `$content` The content delivered by the database
- @return `PH_Data` The data to be send back.

### saveRecord($rawEditorData, $previousRecord = null)
> This method is declared as abstract and is thus marked as `required`

Takes in the PH_Data object delivered by the editor associated with the record type (see `logic-pack.json`), and must return a `PH_Record` object with the edited data. If the $previousRecord argument is null it means that the record is a new record. If it is a `PH_Record` object it means that this is already an existing record that needs to update.

> If you are entering a new record, make sure that the $id property of the `PH_Record` object is set to null, so it does not override anything.

- @param `PH_Data` `$rawEditorData` The editor data delivered by the editor associated with the record type
- @param `PH_Record` `$previousRecord` The previous record, only if the save is for an already existing record (mode = edit).
- @return `PH_Record` The record to put in the database

- - -

## Export Properties
| Property Name | Required? | Type | Explanation |
|---|---|---|---|
| class          | Yes       | `string` | The name of the class of the record type |
| displayName    | No        | `string` | The name to display within the admin panel |
| displayInAdmin | No        | `bool`   | Whether this record type should be displayed within the admin panel |