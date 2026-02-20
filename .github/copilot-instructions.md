# Copilot Instructions for AI Coding Agents

## Project Overview
This is a sample PHP project designed for use with GitHub Codespaces and VS Code Dev Containers. It demonstrates a minimal PHP web application setup, optimized for rapid onboarding and experimentation in containerized development environments.

## Key Files and Structure
- `index.php`: Main entry point for the application. All code changes and experiments should start here.
- `README.md`: Contains detailed setup, workflow, and debugging instructions tailored for Codespaces and Dev Containers.
- `.devcontainer/` (if present): Contains container configuration, including installed extensions and tools (e.g., Xdebug, PHP Intelephense, Code Spell Checker).

## Developer Workflows
- **Edit and Run:**
  - Modify `index.php` to experiment with PHP code.
  - Use the built-in terminal for Linux commands.
- **Debugging:**
  - Set breakpoints in `index.php` and press F5 to debug within the container.
  - For web server debugging, run `php -S 0.0.0.0:8000` and use "Listen for XDebug" in VS Code.
- **Live Reload:**
  - Edit `index.php` and refresh the browser to see changes immediately when running the PHP server.
- **Ports:**
  - Port 8000 is used for the PHP built-in server. Forwarded ports are labeled and managed via Dev Container settings.

## Project Conventions
- All application logic resides in `index.php` unless additional files are added.
- Use the provided container environment for consistent tooling (PHP, Xdebug, Intelephense, spell checker).
- Follow the workflow steps in `README.md` for editing, running, and debugging.

## Integration Points
- No external dependencies or frameworks are used by default.
- Container features (e.g., Node.js) can be added via Dev Container configuration commands.

## Examples
- To start a local server: `php -S 0.0.0.0:8000`
- To debug: Set a breakpoint in `index.php` and use F5 or "Listen for XDebug".

## References
- See `README.md` for step-by-step instructions and troubleshooting tips.
- For container customization, refer to `.devcontainer/devcontainer.json` if present.

---
For any questions or contributions, follow the guidelines in `README.md` and `CODE_OF_CONDUCT.md`.
