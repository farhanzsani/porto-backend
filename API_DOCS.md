# Portfolio CMS — API Documentation

Base URL (production): `http://backend.vellysianazharina.my.id`  
Base URL (local): `http://localhost:8000`  
Interactive docs: `/api/documentation`

All endpoints are **public** — no authentication required.

---

## Response Envelope

Every response follows a consistent structure:

```json
{
  "success": true,
  "message": "Description of the result.",
  "data": {}
}
```

Paginated responses include additional `meta` and `links` keys:

```json
{
  "success": true,
  "message": "...",
  "data": [],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 9,
    "total": 42
  },
  "links": {
    "first": "...",
    "last": "...",
    "prev": null,
    "next": "..."
  }
}
```

---

## Endpoints

### Site

#### `GET /api/site`

Returns public site settings (name, bio, avatar, social links, etc.). Response is cached for 1 hour.

**Response `200`**
```json
{
  "success": true,
  "message": "Site settings retrieved successfully.",
  "data": {
    "site_name": "Vellysia",
    "bio": "...",
    "avatar": "/storage/settings/avatar.jpg",
    "email": "hello@example.com",
    "github_url": "https://github.com/username",
    "linkedin_url": "https://linkedin.com/in/username"
  }
}
```

---

### Projects

#### `GET /api/projects`

Returns a paginated list of projects.

**Query Parameters**

| Parameter | Type | Description |
|---|---|---|
| `page` | integer | Page number (default: 1) |
| `per_page` | integer | Items per page (default: 9) |
| `tech` | string | Filter by technology slug |

**Response `200`**
```json
{
  "success": true,
  "message": "Projects retrieved successfully.",
  "data": [
    {
      "id": 1,
      "slug": "my-project",
      "title": "My Project",
      "description": "Short description.",
      "featured_image": "/storage/projects/image.jpg",
      "client": "Client Name",
      "project_url": "https://example.com",
      "github_url": "https://github.com/user/repo",
      "view_count": 42,
      "technologies": [],
      "created_at": "2024-01-01T00:00:00.000000Z"
    }
  ],
  "meta": { "current_page": 1, "last_page": 1, "per_page": 9, "total": 1 },
  "links": { "first": "...", "last": "...", "prev": null, "next": null }
}
```

---

#### `GET /api/projects/{slug}`

Returns a single project by its slug. Increments the `view_count` on each request.

**Path Parameters**

| Parameter | Type | Description |
|---|---|---|
| `slug` | string | Project slug |

**Response `200`**
```json
{
  "success": true,
  "message": "Project retrieved successfully.",
  "data": {
    "id": 1,
    "slug": "my-project",
    "title": "My Project",
    "description": "Short description.",
    "content": "<p>Full HTML content...</p>",
    "featured_image": "/storage/projects/image.jpg",
    "client": "Client Name",
    "project_url": "https://example.com",
    "github_url": "https://github.com/user/repo",
    "view_count": 43,
    "technologies": [
      { "id": 1, "name": "Laravel", "slug": "laravel", "icon": "...", "color": "#FF2D20" }
    ],
    "media": [],
    "created_at": "2024-01-01T00:00:00.000000Z"
  }
}
```

**Response `404`**
```json
{
  "success": false,
  "message": "Project not found."
}
```

---

### Technologies

#### `GET /api/technologies`

Returns all technologies / skills.

**Query Parameters**

| Parameter | Type | Description |
|---|---|---|
| `featured` | boolean | Pass `1` to return only featured technologies |

**Response `200`**
```json
{
  "success": true,
  "message": "Technologies retrieved successfully.",
  "data": [
    {
      "id": 1,
      "name": "Laravel",
      "slug": "laravel",
      "icon": "<svg>...</svg>",
      "color": "#FF2D20",
      "proficiency_level": "expert",
      "years_experience": 4,
      "is_featured": true
    }
  ]
}
```

---

### Work Experiences

#### `GET /api/work-experiences`

Returns work history ordered by start date (most recent first).

**Response `200`**
```json
{
  "success": true,
  "message": "Work experiences retrieved successfully.",
  "data": [
    {
      "id": 1,
      "company_name": "PT Example",
      "position": "Backend Developer",
      "description": "...",
      "employment_type": "full_time",
      "location": "Jakarta, Indonesia",
      "company_logo": "/storage/work-experiences/logo.png",
      "company_url": "https://example.com",
      "start_date": "2022-01-01",
      "end_date": null,
      "is_current": true
    }
  ]
}
```

---

### Educations

#### `GET /api/educations`

Returns education history ordered by start date (most recent first).

**Response `200`**
```json
{
  "success": true,
  "message": "Educations retrieved successfully.",
  "data": [
    {
      "id": 1,
      "institution_name": "University of Technology",
      "degree": "Bachelor of Science",
      "field_of_study": "Computer Science",
      "description": "...",
      "institution_logo": "/storage/educations/logo.png",
      "institution_url": "https://university.example.com",
      "location": "Jakarta, Indonesia",
      "start_date": "2018-09-01",
      "end_date": "2022-05-31",
      "is_current": false,
      "grade": "3.8 GPA"
    }
  ]
}
```

---

### CV Files

#### `GET /api/cvs`

Returns all active CV files.

**Response `200`**
```json
{
  "success": true,
  "message": "CVs retrieved successfully.",
  "data": [
    {
      "id": 1,
      "title": "My CV 2024",
      "original_filename": "cv-vellysia.pdf",
      "mime_type": "application/pdf",
      "file_size": 204800,
      "file_size_formatted": "200 KB",
      "download_url": "http://backend.vellysianazharina.my.id/api/cvs/1/download",
      "is_active": true,
      "created_at": "2024-01-01 00:00:00"
    }
  ]
}
```

---

#### `GET /api/cvs/{id}/download`

Streams the CV file as a file download. Use the `download_url` from the list endpoint.

**Path Parameters**

| Parameter | Type | Description |
|---|---|---|
| `id` | integer | CV ID |

**Response `200`** — file stream with `Content-Disposition: attachment`

**Response `404`** — CV not found or inactive

---

### Certificates

#### `GET /api/certificates`

Returns all active certificates ordered by issue date (most recent first).

**Response `200`**
```json
{
  "success": true,
  "message": "Certificates retrieved successfully.",
  "data": [
    {
      "id": 1,
      "title": "AWS Certified Developer",
      "issuing_organization": "Amazon Web Services",
      "issue_date": "2024-01-15",
      "expiry_date": "2027-01-15",
      "credential_id": "ABC123XYZ",
      "credential_url": "https://aws.amazon.com/verification/ABC123XYZ",
      "image_path": "/storage/certificates/aws-cert.png",
      "description": "Associate-level certification.",
      "is_active": true,
      "is_expired": false,
      "created_at": "2024-01-15 00:00:00"
    }
  ]
}
```

#### `GET /api/certificates/{id}`

Returns a single active certificate by ID.

**Path Parameters**

| Parameter | Type | Description |
|---|---|---|
| `id` | integer | Certificate ID |

**Response `200`**
```json
{
  "success": true,
  "message": "Certificate retrieved successfully.",
  "data": {
    "id": 1,
    "title": "AWS Certified Developer",
    "issuing_organization": "Amazon Web Services",
    "issue_date": "2024-01-15",
    "expiry_date": "2027-01-15",
    "credential_id": "ABC123XYZ",
    "credential_url": "https://aws.amazon.com/verification/ABC123XYZ",
    "image_path": "/storage/certificates/aws-cert.png",
    "description": "Associate-level certification.",
    "is_active": true,
    "is_expired": false,
    "created_at": "2024-01-15 00:00:00"
  }
}
```

**Response `404`**
```json
{
  "success": false,
  "message": "Certificate not found."
}
```

---

### Inquiries

#### `POST /api/inquiries`

Submits a contact form inquiry. Rate limited to **10 requests per minute** per IP.  
Triggers an email notification to the admin.

**Request Body** `application/json`

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | yes | Full name (max 255) |
| `email` | string | yes | Valid email address |
| `message` | string | yes | Inquiry message |

**Example Request**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "message": "Halo, saya tertarik dengan jasa Anda."
}
```

**Response `201`**
```json
{
  "success": true,
  "message": "Inquiry submitted successfully.",
  "data": { "id": 1 }
}
```

**Response `422`** — validation error
```json
{
  "success": false,
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

**Response `429`** — rate limit exceeded
```json
{
  "success": false,
  "message": "Too Many Attempts."
}
```

---

## Error Responses

| Status | Meaning |
|---|---|
| `404` | Resource not found |
| `422` | Validation failed |
| `429` | Too many requests (rate limited) |
| `500` | Server error |

---

## Notes

- All image/file URLs are relative paths (e.g. `/storage/...`). Prepend the base URL to construct full URLs.
- The `/api/projects/{slug}` endpoint increments `view_count` on every call — avoid calling it unnecessarily in loops or during SSR hydration.
- The `/api/cvs/{id}/download` endpoint streams binary data — use it as an `href` in an anchor tag with `download` attribute, not as a fetch/JSON call.
