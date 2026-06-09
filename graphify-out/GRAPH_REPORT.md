# Graph Report - healthbeyondage-theme  (2026-06-09)

## Corpus Check
- 27 files · ~14,570 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 71 nodes · 49 edges · 29 communities (28 shown, 1 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `f95d1e1f`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- [[_COMMUNITY_Community 2|Community 2]]
- [[_COMMUNITY_Community 5|Community 5]]
- [[_COMMUNITY_Community 20|Community 20]]

## God Nodes (most connected - your core abstractions)
1. `AdSense Approved Health Blog Theme` - 6 edges
2. `hba_article_card()` - 4 edges
3. `Setting up the Theme` - 4 edges
4. `hba_reading_time()` - 3 edges
5. `hba_enqueue_assets()` - 2 edges
6. `hba_get_customizer_css()` - 2 edges
7. `hba_author_initials()` - 2 edges
8. `hba_category_badge_class()` - 2 edges
9. `hba_article_list_item()` - 2 edges
10. `Features` - 1 edges

## Surprising Connections (you probably didn't know these)
- None detected - all connections are within the same source files.

## Import Cycles
- None detected.

## Communities (29 total, 1 thin omitted)

### Community 2 - "Community 2"
Cohesion: 0.40
Nodes (5): hba_article_card(), hba_article_list_item(), hba_author_initials(), hba_category_badge_class(), hba_reading_time()

### Community 20 - "Community 20"
Cohesion: 0.20
Nodes (9): 1. Front Page Setup, 2. About Page Setup, 3. Customizing the Theme (Appearance > Customize), AdSense Approved Health Blog Theme, Development, Features, Installation Guide, License (+1 more)

## Knowledge Gaps
- **7 isolated node(s):** `Features`, `Installation Guide`, `1. Front Page Setup`, `2. About Page Setup`, `3. Customizing the Theme (Appearance > Customize)` (+2 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **1 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `hba_article_card()` connect `Community 2` to `Community 0`?**
  _High betweenness centrality (0.001) - this node is a cross-community bridge._
- **What connects `Features`, `Installation Guide`, `1. Front Page Setup` to the rest of the system?**
  _7 weakly-connected nodes found - possible documentation gaps or missing edges._