# Gears4MusicTechTest
Endpoints
## Routes
### /api/consignment
- Valid methods GET, POST, PUT, DELETE
- Only Post method works for creation
- GET, PUT & DELETE need implementing
Required body 
```json
{
	"courier": 2,
	"uniqueReference": 32
}
```
- the courier must be an integer and not null
- the uniqueReference must be an integer and not null
- the batch will automatically be attached if there is a current batch

####Headers that must be set

- Accept - application/json 
- Content-Type - application/json 
