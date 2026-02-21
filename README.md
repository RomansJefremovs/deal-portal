# Deal Portal

Laravel 12 application that receives HubSpot deal webhooks, creates user accounts, and provides a personal cabinet for viewing deals.

## Webhook Endpoint
```
POST https://your-domain.com/webhook/hubspot
```
Update this URL in HubSpot after deployment.

## Key .env Values
```env
APP_ENV=production
APP_DEBUG=false
QUEUE_CONNECTION=database
```

## Notes
- `/webhook/hubspot` is excluded from CSRF protection by design
- HubSpot signature verification is planned for a future iteration
- MAIL_MAILER must use a real SMTP provider in production (e.g. Mailgun, SendGrid, Postmark)
- Welcome email is sent to the client's email address from the HubSpot deal payload
- Mailtrap is for local development only — never use it in production
